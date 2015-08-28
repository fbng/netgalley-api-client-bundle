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
                        ->scalarNode('key')->defaultNull()->end()
                        ->scalarNode('secret')->defaultNull()->end()
                        ->scalarNode('user')->defaultNull()->end()
                    ->end()
                ->end() // end auth
                ->arrayNode('oauth')
                    ->children()
                        ->scalarNode('client')->defaultNull()->end()
                        ->scalarNode('secret')->defaultNull()->end()
                    ->end()
                ->end() // end auth
                ->arrayNode('options')
                    ->children()
                        ->scalarNode('test_domain')->defaultNull()->end()
                        ->scalarNode('test_mode')->defaultNull()->end()
                    ->end()
                ->end() // end options
            ->end()
        ;

        return $treeBuilder;
    }
}
