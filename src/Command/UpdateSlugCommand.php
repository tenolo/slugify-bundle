<?php

namespace Tenolo\Bundle\SlugifyBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;
use Tenolo\Bundle\SlugifyBundle\Slugification\SlugificationInterface;

/**
 * Class UpdateSlugCommand
 *
 * @package Tenolo\Bundle\SlugifyBundle\Command
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class UpdateSlugCommand extends Command
{

    /** @var ManagerRegistry */
    protected $registry;

    /** @var SlugificationInterface */
    protected $slugification;

    /**
     * @param ManagerRegistry        $registry
     * @param SlugificationInterface $slugification
     */
    public function __construct(ManagerRegistry $registry, SlugificationInterface $slugification)
    {
        $this->registry = $registry;
        $this->slugification = $slugification;

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('tenolo:slugify:update');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityManager = $this->registry->getManager();
        $slugification = $this->slugification;

        /** @var ClassMetadata[] $allMetadata */
        $allMetadata = $entityManager->getMetadataFactory()->getAllMetadata();

        /** @var SlugifyInterface[] $objects */
        $objects = [];
        $output->writeln('update slugs for following classes:');

        foreach ($allMetadata as $metadata) {
            $reflection = $metadata->getReflectionClass();

            if ($reflection->implementsInterface(SlugifyInterface::class)) {
                $output->writeln($reflection->getName());
                $all = $entityManager->getRepository($reflection->getName())->findAll();

                $objects = array_merge($objects, $all);
            }
        }

        $counter = count($objects);

        $output->writeln('');
        $output->writeln('found ' . $counter . ' objects');

        $progress = new ProgressBar($output, $counter);
        $progress->setFormat(' %message% %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s%');

        foreach ($objects as $one) {
            $progress->setMessage('update slug');
            $progress->advance();

            if (!$one->hasSlug() || !$one->isCustomSlug()) {
                $slugification->slugify($one);
            }

            $entityManager->persist($one);
        }

        $progress->setMessage('update finished');
        $progress->finish();
        $output->writeln('');
        $output->writeln('');
        $output->writeln('flush to database');

        $entityManager->flush();
    }

}
