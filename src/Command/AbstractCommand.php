<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Command;

use DToch56\SymfonyProbeBundle\Trait\AddProbeTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

abstract class AbstractCommand extends Command
{
    use AddProbeTrait;

    protected function configure(): void
    {
        $this->addArgument(
            'check', InputArgument::OPTIONAL, 'Run only selected check from probe'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $response = $this->probe->run($input->getArgument('check'));
            $output->write($response->toArray());
            $output->write($response->isSuccess() ? 'success' : 'error');

            return $response->isSuccess() ? Command::SUCCESS : Command::FAILURE;
        } catch (Throwable $e) {
            $output->write('Error: ' . $e->getMessage());

            return Command::FAILURE;
        }
    }
}
