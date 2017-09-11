<?php

namespace Tenolo\Bundle\SlugifyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

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
        $tags = $container->findTaggedServiceIds('tenolo_slugify.slugification.slugger');

        foreach ($tags as $id => $params) {
            foreach ($params as $param) {
                if (!isset($param['class'])) {
                    throw new \InvalidArgumentException('Tagged SluggerInterface needs to have `class` attributes.');
                }

                $definition->addMethodCall('addDelegate', [
                    $param['class'],
                    new Reference($id)
                ]);
            }
        }
    }
}