<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Controller;

use DToch56\SymfonyProbeBundle\Trait\AddProbeTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as FrameworkAbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends FrameworkAbstractController
{
    use AddProbeTrait;

    protected function run(string $check = null): JsonResponse
    {
        try {
            $response = $this->probe->run($check);

            return new JsonResponse(
                $response->toArray(), $response->isSuccess() ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR
            );
        } catch (\Throwable $e) {
            return new JsonResponse(
                $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
