<?php

namespace Tenolo\Bundle\SlugifyBundle\Slugification\Slugger;

use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;

/**
 * Class DefaultSlugger
 *
 * @package Tenolo\Bundle\SlugifyBundle\Slugification\Slugger
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DefaultSlugger implements SluggerInterface
{

    /**
     * @inheritDoc
     */
    public function getRawMaterial(SlugifyInterface $slugify)
    {
        return $slugify->getSlugRawMaterial();
    }

}
