<?php

namespace Tenolo\Bundle\SlugifyBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tenolo\Bundle\SlugifyBundle\DependencyInjection\Compiler\SluggerPass;

/**
 * Class TenoloSlugifyBundle
 *
 * @package Tenolo\Bundle\SlugifyBundle
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TenoloSlugifyBundle extends Bundle
{

    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SluggerPass());
    }
}
