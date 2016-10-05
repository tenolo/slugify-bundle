<?php

namespace Tenolo\Bundle\SlugifyBundle\Repository\Interfaces;

/**
 * Interface SlugifyRepositoryInterface
 *
 * @package Tenolo\Bundle\SlugifyBundle\Repository\Interfaces
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface SlugifyRepositoryInterface
{

    /**
     * @param string $slug
     *
     * @return mixed
     */
    public function findOneBySlug($slug);
}
