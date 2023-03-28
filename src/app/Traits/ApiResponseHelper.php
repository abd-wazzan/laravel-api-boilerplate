<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use JsonSerializable;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

use function response;

trait ApiResponseHelper
{
    public function okResponse(
        array|Arrayable|JsonSerializable|string|null $data = [],
        ?string $message = null,
        array $headers = []
    ): JsonResponse {
        $status = Response::HTTP_OK;
        return $this->jsonResponse(
            [
                'message' => $message ?? $this->morphStatusMessage($status),
                'data' => $this->morphToArray($data)
            ],
            $status,
            $headers
        );
    }

    public function createdResponse(
        array|Arrayable|JsonSerializable|string|null $data = [],
        ?string $message = null,
        array $headers = []
    ): JsonResponse {
        $status = Response::HTTP_CREATED;
        return $this->jsonResponse(
            [
                'message' => $message ?? $this->morphStatusMessage($status),
                'data' => $this->morphToArray($data)
            ],
            $status,
            $headers
        );
    }

    public function failedResponse(
        ?string $message = null,
        array $headers = []
    ): JsonResponse {
        $status = Response::HTTP_BAD_REQUEST;
        return $this->jsonResponse(
            ['message' => $message ?? $this->morphStatusMessage($status)],
            $status,
            $headers
        );
    }

    public function unprocessableResponse(
        Throwable|array|Arrayable|JsonSerializable|string|null $errors = [],
        ?string $message = null,
        array $headers = []
    ): JsonResponse {
        $status = Response::HTTP_UNPROCESSABLE_ENTITY;
        return $this->jsonResponse(
            [
                'message' => $message ?? $this->morphStatusMessage($status),
                'errors' => $this->morphValidationErrors($errors)
            ],
            $status,
            $headers
        );
    }


    public function notFoundResponse(
        ?string $message = null,
        array $headers = []
    ): JsonResponse {
        $status = Response::HTTP_NOT_FOUND;
        return $this->jsonResponse(
            ['message' => $message ?? $this->morphStatusMessage($status)],
            $status,
            $headers
        );
    }

    public function unauthorizedResponse(
        ?string $message = null,
        array $headers = []
    ): JsonResponse {
        $status = Response::HTTP_UNAUTHORIZED;
        return $this->jsonResponse(
            ['message' => $message ?? $this->morphStatusMessage($status)],
            $status,
            $headers
        );
    }

    public function forbiddenResponse(
        ?string $message = null,
        array $headers = []
    ): JsonResponse {
        $status = Response::HTTP_FORBIDDEN;
        return $this->jsonResponse(
            ['message' => $message ?? $this->morphStatusMessage($status)],
            $status,
            $headers
        );
    }

    public function serverErrorResponse(
        ?string $message = null,
        array $headers = []
    ): JsonResponse {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        return $this->jsonResponse(
            ['message' => $message ?? $this->morphStatusMessage($status)],
            $status,
            $headers
        );
    }


    private function jsonResponse(array $data, int $code = Response::HTTP_OK, $headers = []): JsonResponse
    {
        return response()->json($data, $code, $headers);
    }

    private function morphToArray(array|Arrayable|JsonSerializable|null|string $data = []): array
    {
        if (is_array($data)) {
            return $data;
        }

        if ($data instanceof Arrayable) {
            return $data->toArray();
        }

        if ($data instanceof JsonSerializable) {
            return $data->jsonSerialize();
        }

        if (is_string($data)) {
            return [$data];
        }

        return [];
    }

    private function morphValidationErrors(Throwable|array|Arrayable|JsonSerializable|string|null $errors = []): array
    {
        return $errors instanceof Throwable ? [$errors->getMessage()] : $this->morphToArray($errors);
    }

    private function morphStatusMessage(int $statusCode): string
    {
        return Response::$statusTexts[$statusCode] ?? 'unknown status';
    }
}
