<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use DToch56\SymfonyProbeBundle\Controller\HealthController;
use DToch56\SymfonyProbeBundle\Controller\PingController;

class SymfonyProbeExtension extends Extension
{
    /**
     * @param array<array> $configs
     *
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('controller.xml');

        $this->loadProbes($config, $loader, $container);
    }

    /**
     * @param array<array> $config
     */
    private function loadProbes(
        array $config,
        XmlFileLoader $loader,
        ContainerBuilder $container
    ): void {
        $loader->load('probes.xml');

        $healthCheckCollection = $container->findDefinition(HealthController::class);

        foreach ($config['health_checks'] as $healthCheckConfig) {
            $healthCheckDefinition = new Reference($healthCheckConfig['id']);
            $healthCheckCollection->addMethodCall('addProbe', [$healthCheckDefinition]);
        }

        $pingCollection = $container->findDefinition(PingController::class);
        foreach ($config['ping_checks'] as $healthCheckConfig) {
            $healthCheckDefinition = new Reference($healthCheckConfig['id']);
            $pingCollection->addMethodCall('addProbe', [$healthCheckDefinition]);
        }
    }
}
