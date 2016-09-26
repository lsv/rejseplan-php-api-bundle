<?php

namespace Lsv\RejseplanApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('lsv_rejseplan_api');
        $rootNode
            ->children()
                ->scalarNode('baseurl')
                    ->isRequired()
                    ->info('Rejseplan API base url')
                ->end()
                ->scalarNode('client')
                    ->info('Guzzle client you want to use')
                    ->defaultNull()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
