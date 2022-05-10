<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Check;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Throwable;

class EnvironmentCheck implements CheckInterface
{
    public function __construct(private readonly ContainerInterface $container)
    {
    }

    public function getName(): string
    {
        return 'environment';
    }

    public function check(): Response
    {
        try {
            $env = $this->container->getParameter('kernel.environment');
        } catch (Throwable $e) {
            return new Response(
                $this->getName(),
                false,
                'Could not determine',
                ['error' => $e->getMessage()]
            );
        }

        return new Response($this->getName(), true, 'ok', [$env]);
    }
}
