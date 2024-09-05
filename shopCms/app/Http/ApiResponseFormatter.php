<?php

declare(strict_types=1);

namespace App\Http;

use Throwable;

final class ApiResponseFormatter
{
    public function formatMessage(string $message, int $statusCode = 200): array
    {
        return [
            'status' => 'success',
            'statusCode' => $statusCode,
            'payload' => [
                'message' => $message,
            ],
        ];
    }

    public function formatPayload(array $payload, string $message = '', int $statusCode = 200): array
    {
        return [
            'status' => 'success',
            'statusCode' => $statusCode,
            'payload' => $payload,
            'message' => $message
        ];
    }

    public function formatException(Throwable $e, int $statusCode = 500): array
    {
        return [
            'status' => 'error',
            'statusCode' => $statusCode,
            'error' => [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ],
        ];
    }
}
