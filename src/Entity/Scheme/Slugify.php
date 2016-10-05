<?php

namespace Tenolo\Bundle\SlugifyBundle\Entity\Scheme;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", nullable=true)
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
