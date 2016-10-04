<?php

namespace Tenolo\Bundle\SlugifyBundle\Entity\Interfaces;

/**
 * Interface SlugifyInterface
 *
 * @package Tenolo\Bundle\SlugifyBundle\Entity\Interfaces
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface SlugifyInterface
{

    /**
     * @return string
     */
    public function getSlug();

    /**
     * @param string $slug
     */
    public function setSlug($slug);

    /**
     * @return string
     */
    public function getSlugRawMaterial();
}
