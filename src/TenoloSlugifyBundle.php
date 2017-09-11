<?php

namespace Tenolo\Bundle\SlugifyBundle;

use Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Mmoreram\SymfonyBundleDependencies\DependentBundleInterface;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;
use Tenolo\Bundle\SlugifyBundle\DependencyInjection\Compiler\SluggerPass;

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
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SluggerPass());
    }

    /**
     * @inheritDoc
     */
    public static function getBundleDependencies(KernelInterface $kernel)
    {
        return [
            FrameworkBundle::class,
            DoctrineBundle::class,
            CocurSlugifyBundle::class,
        ];
    }
}
