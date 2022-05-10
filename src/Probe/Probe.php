<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Probe;

use DToch56\SymfonyProbeBundle\Check\CheckInterface;

class Probe
{
    /**
     * @param array<CheckInterface> $checks
     */
    public function __construct(
        private readonly array $checks,
        private readonly bool $stopOnFirstError = false
    ) {
    }

    public function run(string $checkName = null): Response
    {
        $success = true;
        $checkResults = [];

        foreach ($this->checks as $check) {
            if ($checkName === null || $checkName === $check->getName()) {
                $checkResponse = $check->check();
                $checkResults[] = $checkResponse->toArray();
                if ($checkResponse->isSuccess() !== true) {
                    $success = false;
                    if ($this->stopOnFirstError) {
                        break;
                    }
                }
            }
        }

        return new Response($success, $checkResults);
    }
}
