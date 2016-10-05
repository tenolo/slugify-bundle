<?php

namespace Tenolo\Bundle\SlugifyBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;
use Tenolo\Bundle\SlugifyBundle\Slugification\SlugificationDelegatorInterface;

/**
 * Class SurveySlugListener
 *
 * @package Tenolo\Bundle\SlugifyBundle\EventListener
 * @author  Jan Plückelmann
 * @company tenolo GbR
 */
class SlugListener
{

    /** @var SlugificationDelegatorInterface */
    protected $slugification;

    /**
     * @param SlugificationDelegatorInterface $slugification
     */
    public function __construct(SlugificationDelegatorInterface $slugification)
    {
        $this->slugification = $slugification;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $reflection = new \ReflectionClass($entity);

        if ($reflection->implementsInterface(SlugifyInterface::class)) {
            /** @var SlugifyInterface $entity */
            $this->slugify($entity);
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $reflection = new \ReflectionClass($entity);

        if ($reflection->implementsInterface(SlugifyInterface::class)) {
            /** @var SlugifyInterface $entity */
            $this->slugify($entity);
        }
    }

    /**
     * @param SlugifyInterface $slugify
     *
     * @throws \Exception
     * @throws \Throwable
     */
    protected function slugify(SlugifyInterface $slugify)
    {
        $slug = $slugify->getSlug();

        if (empty($slug)) {
            $this->slugification->slugify($slugify);
        }
    }

}