<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Probe;

use DToch56\SymfonyProbeBundle\Check\Response as CheckResponse;

class Response
{
    /**
     * @param array<CheckResponse> $checks
     */
    public function __construct(
        private readonly bool $success,
        private readonly array $checks = []
    ) {
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getChecks(): array
    {
        return $this->checks;
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'success' => $this->isSuccess(),
            'checks' => $this->getChecks(),
        ];
    }
}
