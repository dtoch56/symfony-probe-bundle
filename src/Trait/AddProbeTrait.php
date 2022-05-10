<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Trait;

use DToch56\SymfonyProbeBundle\Probe\Probe;

trait AddProbeTrait
{
    private Probe $probe;

    public function addProbe(Probe $probe): void {
        $this->probe = $probe;
    }
}
