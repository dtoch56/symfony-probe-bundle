<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('symfony_probe');

        /** @var ArrayNodeDefinition $root */
        $root = method_exists(TreeBuilder::class, 'getRootNode')
            ? $treeBuilder->getRootNode()
            : $treeBuilder->root('symfony_probe');

        $root
            ->children()
                ->arrayNode('health_checks')
                    ->children()
                        ->booleanNode('stopOnFirstError')
                            ->defaultFalse()
                        ->end()
                        ->arrayNode('checks')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('id')->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('ping_checks')
                    ->children()
                        ->booleanNode('stopOnFirstError')
                            ->defaultFalse()
                        ->end()
                        ->arrayNode('checks')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('id')->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
