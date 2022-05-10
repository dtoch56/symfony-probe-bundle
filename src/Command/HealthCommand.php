<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'probe:health',
    description: 'Run health checks.',
    hidden: false
)]
final class HealthCommand extends AbstractCommand
{
}
