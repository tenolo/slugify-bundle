<?php

namespace Tenolo\Bundle\SlugifyBundle;

use Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle;
use Mmoreram\SymfonyBundleDependencies\DependentBundleInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class TenoloSlugifyBundle
 *
 * @package Tenolo\Bundle\SlugifyBundle
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TenoloSlugifyBundle extends Bundle implements DependentBundleInterface
{

    /**
     * @inheritDoc
     */
    public static function getBundleDependencies(KernelInterface $kernel)
    {
        return [
            CocurSlugifyBundle::class,
        ];
    }
}
