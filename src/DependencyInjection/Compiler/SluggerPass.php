<?php

namespace Tenolo\Bundle\SlugifyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class SluggerPass
 *
 * @package Tenolo\Bundle\SlugifyBundle\DependencyInjection\Compiler
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class SluggerPass implements CompilerPassInterface
{

    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('tenolo_slugify.slugification')) {
            return;
        }

        $definition = $container->getDefinition('tenolo_slugify.slugification');

        foreach ($container->findTaggedServiceIds('tenolo_slugify.slugification.slugger') as $id => $params) {
            if (!isset($params[0]['class'])) {
                throw new \InvalidArgumentException('Tagged SluggerInterface needs to have `class` attributes.');
            }

            foreach ($params as $param) {
                $definition->addMethodCall('addDelegate', [
                    $param['class'],
                    $id
                ]);
            }
        }
    }
}