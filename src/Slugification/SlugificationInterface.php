<?php

namespace Tenolo\Bundle\SlugifyBundle\Slugification;

use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;

/**
 * Interface SlugificationInterface
 *
 * @package Tenolo\Bundle\SlugifyBundle\Slugification
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface SlugificationInterface
{

    /**
     * @param SlugifyInterface $slugify
     *
     * @return string
     */
    public function slugify(SlugifyInterface $slugify);
}
