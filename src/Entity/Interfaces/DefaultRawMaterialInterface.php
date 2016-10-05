<?php

namespace Tenolo\Bundle\SlugifyBundle\Entity\Interfaces;

/**
 * Interface DefaultRawMaterialInterface
 *
 * @package Tenolo\Bundle\SlugifyBundle\Entity\Interfaces
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface DefaultRawMaterialInterface
{

    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();
}
