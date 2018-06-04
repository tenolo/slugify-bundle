<?php

namespace Tenolo\Bundle\SlugifyBundle\Slugification;

use Cocur\Slugify\SlugifyInterface as CocurSlugifyInterface;
use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface as ORMSlugifyInterface;

/**
 * Class Slugification
 *
 * @package Tenolo\Bundle\SlugifyBundle\Slugification
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class Slugification implements SlugificationInterface
{

    /** @var CocurSlugifyInterface */
    protected $slugify;

    /**
     * @param CocurSlugifyInterface $slugify
     */
    public function __construct(CocurSlugifyInterface $slugify)
    {
        $this->slugify = $slugify;
    }

    /**
     * @param ORMSlugifyInterface $slugify
     *
     * @return string
     */
    public function slugify(ORMSlugifyInterface $slugify)
    {
        // get the raw material for slugify
        $rawMaterial = $slugify->getSlugRawMaterial();

        // there is not raw material
        if ($rawMaterial === null) {
            return null;
        }

        // get slug
        $slug = $this->getSlugifier()->slugify($rawMaterial);

        // set slug
        $slugify->setSlug($slug);

        // now return it
        return $slug;
    }

    /**
     * @return CocurSlugifyInterface
     */
    protected function getSlugifier()
    {
        return $this->slugify;
    }
}
