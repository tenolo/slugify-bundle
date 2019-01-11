<?php

namespace Tenolo\Bundle\SlugifyBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;
use Tenolo\Bundle\SlugifyBundle\Slugification\SlugificationInterface;

/**
 * Class SurveySlugListener
 *
 * @package Tenolo\Bundle\SlugifyBundle\EventListener
 * @author  Jan Plückelmann
 * @company tenolo GbR
 */
class SlugListener implements EventSubscriberInterface
{

    /** @var SlugificationInterface */
    protected $slugification;

    /**
     * @param SlugificationInterface $slugification
     */
    public function __construct(SlugificationInterface $slugification)
    {
        $this->slugification = $slugification;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            'preUpdate',
            'prePersist',
            'postLoad',
        ];
    }

    /**
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
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
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $reflection = new \ReflectionClass($entity);

        if ($reflection->implementsInterface(SlugifyInterface::class)) {
            /** @var SlugifyInterface $entity */
            $this->slugify($entity, true);

            $args->getEntityManager()->persist($entity);
        }
    }

    /**
     * @param SlugifyInterface $slugify
     * @param bool             $checkEmpty
     */
    protected function slugify(SlugifyInterface $slugify, $checkEmpty = false)
    {
        if ($checkEmpty && $slugify->hasSlug()) {
            return;
        }

        // if custom slug is set, do not reset
        if ($slugify->hasSlug() && $slugify->isCustomSlug()) {
            return;
        }

        $this->slugification->slugify($slugify);
    }

}