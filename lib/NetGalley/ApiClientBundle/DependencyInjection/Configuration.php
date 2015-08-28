<?php

namespace NetGalley\ApiClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Validate and merge configuration settings.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('net_galley_api_client');

        $rootNode
            ->children()
                ->arrayNode('auth')
                    ->children()
                        ->scalarNode('key')->end()
                        ->scalarNode('secret')->end()
                        ->scalarNode('user')->end()
                    ->end()
                ->end() // end auth
                ->arrayNode('oauth')
                    ->children()
                        ->scalarNode('client')->end()
                        ->scalarNode('secret')->end()
                    ->end()
                ->end() // end auth
                ->arrayNode('options')
                    ->children()
                        ->scalarNode('test_domain')->end()
                        ->scalarNode('test_mode')->end()
                    ->end()
                ->end() // end options
            ->end()
        ;

        return $treeBuilder;
    }
}
