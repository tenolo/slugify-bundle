<?php

namespace Tenolo\Bundle\SlugifyBundle\Slugification;

use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;
use Tenolo\Utilities\Delegation\AbstractDelegator;

/**
 * Class SluggerDelegator
 *
 * @package Tenolo\Bundle\SlugifyBundle\Slugification
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class SluggerDelegator extends AbstractDelegator implements SluggerDelegatorInterface
{

    /** @var \Cocur\Slugify\SlugifyInterface */
    protected $slugify;

    /**
     * @param \Cocur\Slugify\SlugifyInterface $slugify
     */
    public function __construct(\Cocur\Slugify\SlugifyInterface $slugify)
    {
        $this->slugify = $slugify;
    }

    /**
     * @param SlugifyInterface $slugify
     *
     * @return string
     */
    public function slugify(SlugifyInterface $slugify)
    {
        $rawMaterial = $this->getDelegate('awef')->slugify($slugify->getSlug());

        $slug = $this->slugify($rawMaterial);

        $slugify->setSlug($slug);

        return $slug;
    }
}
