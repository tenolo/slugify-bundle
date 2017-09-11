<?php

namespace Tenolo\Bundle\SlugifyBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
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