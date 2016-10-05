<?php

namespace Tenolo\Bundle\SlugifyBundle\Entity\Scheme;

/**
 * Class DefaultRawMaterial
 *
 * @package Tenolo\Bundle\SlugifyBundle\Entity\Scheme
 * @author  Nikita Loges
 * @company tenolo GbR
 */
trait DefaultRawMaterial
{

    /**
     * @return string
     */
    public function getSlugRawMaterial()
    {
        return $this->getId() . '-' . $this->getName();
    }
}
