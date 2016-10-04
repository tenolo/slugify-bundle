<?php

namespace Tenolo\Bundle\SlugifyBundle\Entity\Scheme;

/**
 * Trait Slugify
 *
 * @package Tenolo\Bundle\SlugifyBundle\Entity\Scheme
 * @author  Nikita Loges
 * @company tenolo GbR
 */
trait Slugify
{

    /**
     * @var string
     */
    protected $slug;

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}
