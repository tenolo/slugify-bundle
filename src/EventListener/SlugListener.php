<?php

namespace Tenolo\Bundle\SlugifyBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;
use Tenolo\Bundle\SlugifyBundle\Slugification\SluggerDelegatorInterface;

/**
 * Class SurveySlugListener
 *
 * @package Tenolo\Bundle\SlugifyBundle\EventListener
 * @author  Jan Plückelmann
 * @company tenolo GbR
 */
class SlugListener
{

    /** @var SluggerDelegatorInterface */
    protected $slugger;

    /**
     * @param SluggerDelegatorInterface $slugger
     */
    public function __construct(SluggerDelegatorInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof SlugifyInterface) {
            $this->slugify($entity);
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof SlugifyInterface) {
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
            $this->slugger->slugify($slugify);
        }
    }

}