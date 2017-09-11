<?php

namespace Tenolo\Bundle\SlugifyBundle\Slugification;

use Cocur\Slugify\SlugifyInterface as CocurSlugifyInterface;
use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface as ORMSlugifyInterface;
use Tenolo\Bundle\SlugifyBundle\Slugification\Slugger\SluggerInterface;
use Tenolo\Utilities\Delegation\AbstractObjectDelegator;
use Tenolo\Utilities\Delegation\Depository\ObjectDepository;

/**
 * Class SlugificationDelegator
 *
 * @package Tenolo\Bundle\SlugifyBundle\Slugification
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class SlugificationDelegator extends AbstractObjectDelegator implements SlugificationDelegatorInterface
{

    /** @var CocurSlugifyInterface */
    protected $slugify;

    /**
     * @param CocurSlugifyInterface $slugify
     * @param null                  $default
     */
    public function __construct(CocurSlugifyInterface $slugify, $default = null)
    {
        parent::__construct($default, new ObjectDepository(SluggerInterface::class));

        $this->slugify = $slugify;
    }

    /**
     * @param ORMSlugifyInterface $slugify
     *
     * @return string
     */
    public function slugify(ORMSlugifyInterface $slugify)
    {
        /** @var SluggerInterface $delegate */
        $delegate = $this->getDelegateByObject($slugify);

        // there is not delegate
        if (is_null($delegate)) {
            return null;
        }

        // get the raw material for slugify
        $rawMaterial = $delegate->getRawMaterial($slugify);

        // there is not raw material
        if (is_null($rawMaterial)) {
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
