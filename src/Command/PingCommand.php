<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'probe:ping',
    description: 'Run ping checks.',
    hidden: false
)]
final class PingCommand extends AbstractCommand
{
}
