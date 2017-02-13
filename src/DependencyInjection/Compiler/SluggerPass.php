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

    CONST SERVICE_KEY = 'tenolo_slugify.slugification';
    CONST TAG_KEY = 'tenolo_slugify.slugification.slugger';

    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(self::SERVICE_KEY)) {
            return;
        }

        $definition = $container->getDefinition(self::SERVICE_KEY);

        foreach ($container->findTaggedServiceIds(self::TAG_KEY) as $id => $params) {
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