<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Check;

interface CheckInterface
{
    public function getName(): string;

    public function check(): Response;
}
