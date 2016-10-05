<?php

namespace Tenolo\Bundle\SlugifyBundle\Repository\Scheme;

/**
 * Trait SlugifyRepository
 *
 * @package Tenolo\Bundle\SlugifyBundle\Repository\Scheme
 * @author  Nikita Loges
 * @company tenolo GbR
 */
trait SlugifyRepository
{

    /**
     * @param string $slug
     *
     * @return mixed
     */
    public function findOneBySlug($slug)
    {
        return $this->findOneBy([
            'slug' => $slug
        ]);
    }
}
