<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Check;

class StatusUpCheck implements CheckInterface
{
    public function getName(): string
    {
        return 'status';
    }

    public function check(): Response
    {
        return new Response($this->getName(), true, 'up');
    }
}
