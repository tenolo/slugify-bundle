<?php

namespace Tenolo\Bundle\SlugifyBundle\Slugification;

use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;
use Tenolo\Utilities\Delegation\AbstractDelegatorInterface;

/**
 * Interface SlugificationDelegatorInterface
 *
 * @package Tenolo\Bundle\SlugifyBundle\Slugification
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface SlugificationDelegatorInterface extends AbstractDelegatorInterface
{

    /**
     * @param SlugifyInterface $slugify
     *
     * @return string
     */
    public function slugify(SlugifyInterface $slugify);
}
