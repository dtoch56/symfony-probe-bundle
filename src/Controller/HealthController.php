<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class HealthController extends AbstractController
{
    #[Route('/health/{check?}', name: 'health', methods: ["GET"])]
    public function healthCheckAction(string $check = null): JsonResponse
    {
        return $this->run($check);
    }
}
