<?php

declare(strict_types=1);

namespace DToch56\SymfonyProbeBundle\Check;

class Response
{
    /**
     * @param mixed[] $params
     */
    public function __construct(
        private readonly string $name,
        private readonly bool $success,
        private readonly string $message,
        private readonly array $params = []
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return mixed[]
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'success' => $this->isSuccess(),
            'message' => $this->getMessage(),
            'params' => $this->getParams(),
        ];
    }
}
