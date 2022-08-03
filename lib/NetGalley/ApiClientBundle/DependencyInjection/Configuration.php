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
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('net_galley_api_client');

        $rootNode = method_exists($treeBuilder, 'getRootNode')
            ? $treeBuilder->getRootNode()
            : $treeBuilder->root('net_galley_api_client')
        ;

        $rootNode
            ->children()
                ->arrayNode('auth')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('key')->defaultNull()->end()
                        ->scalarNode('secret')->defaultNull()->end()
                        ->scalarNode('user')->defaultNull()->end()
                    ->end()
                ->end() // end auth
                ->arrayNode('oauth')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('client')->defaultNull()->end()
                        ->scalarNode('secret')->defaultNull()->end()
                    ->end()
                ->end() // end auth
                ->arrayNode('options')
                    ->addDefaultsIfNotSet()
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
