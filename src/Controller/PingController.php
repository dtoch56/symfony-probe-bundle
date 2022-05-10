<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class PingController extends AbstractController
{
    #[Route('/ping/{check?}', name: 'ping', methods: ["GET"])]
    public function pingAction(string $check = null): JsonResponse
    {
        return $this->run($check);
    }
}
