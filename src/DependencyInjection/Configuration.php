<?php

namespace Tenolo\Bundle\SlugifyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package Tenolo\Bundle\SlugifyBundle\DependencyInjection
 * @author  Jan Plückelmann
 */
class Configuration implements ConfigurationInterface
{

    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tenolo_slugify');

        return $treeBuilder;
    }
}
