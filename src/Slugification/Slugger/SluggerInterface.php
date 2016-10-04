<?php

namespace Tenolo\Bundle\SlugifyBundle\Slugification\Slugger;

use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;

/**
 * Interface SluggerInterface
 *
 * @package Tenolo\Bundle\SlugifyBundle\Slugification\Slugger
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface SluggerInterface
{

    /**
     * @param SlugifyInterface $slugify
     *
     * @return string
     */
    public function getRawMaterial(SlugifyInterface $slugify);
}
