<?php

namespace Tenolo\Bundle\SlugifyBundle\Slugification;

use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;

/**
 * Interface SluggerDelegatorInterface
 *
 * @package Tenolo\Bundle\SlugifyBundle\Slugification
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface SluggerDelegatorInterface
{

    /**
     * @param SlugifyInterface $slugify
     *
     * @return string
     */
    public function slugify(SlugifyInterface $slugify);
}
