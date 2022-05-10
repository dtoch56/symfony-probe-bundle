<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Tests;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use DToch56\SymfonyProbeBundle\SymfonyProbeBundle;

class TestKernel extends Kernel
{
    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
            new SymfonyProbeBundle(),
        ];
    }

    public function getProjectDir(): string
    {
        return __DIR__ . '/../src';
    }

    public function getRootDir(): string
    {
        return $this->getProjectDir();
    }

    public function getCacheDir(): string
    {
        return dirname(__DIR__) . '/var/cache/' . $this->getEnvironment();
    }

    public function getLogDir(): string
    {
        return dirname(__DIR__) . '/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__ . '/config.yml');
    }
}
