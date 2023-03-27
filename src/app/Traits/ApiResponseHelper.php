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
        ?string $message = 'Operation succeeded.',
        array $headers = []
    ): JsonResponse {
        return $this->jsonResponse(
            ['message' => $message, 'data' => $this->morphToArray($data)],
            Response::HTTP_OK,
            $headers
        );
    }

    public function createdResponse(
        array|Arrayable|JsonSerializable|string|null $data = [],
        ?string $message = 'Created.',
        array $headers = []
    ): JsonResponse {
        return $this->jsonResponse(
            ['message' => $message, 'data' => $this->morphToArray($data)],
            Response::HTTP_OK,
            $headers
        );
    }

    public function failedResponse(
        ?string $message = 'Operation failed.',
        array $headers = []
    ): JsonResponse {
        return $this->jsonResponse(
            ['message' => $message],
            Response::HTTP_BAD_REQUEST,
            $headers
        );
    }

    public function unprocessableResponse(
        Throwable|array|Arrayable|JsonSerializable|string|null $errors = [],
        ?string $message = 'Validation failed.',
        array $headers = []
    ): JsonResponse {
        return $this->jsonResponse(
            ['message' => $message, 'errors' => $this->morphValidationErrors($errors)],
            Response::HTTP_UNPROCESSABLE_ENTITY,
            $headers
        );
    }


    public function notFoundResponse(
        ?string $message = 'Not Found.',
        array $headers = []
    ): JsonResponse {
        return $this->jsonResponse(
            ['message' => $message],
            Response::HTTP_NOT_FOUND,
            $headers
        );
    }

    public function unauthorizedResponse(
        ?string $message = 'Unauthorized.',
        array $headers = []
    ): JsonResponse {
        return $this->jsonResponse(
            ['message' => $message],
            Response::HTTP_UNAUTHORIZED,
            $headers
        );
    }

    public function forbiddenResponse(
        ?string $message = 'Forbidden.',
        array $headers = []
    ): JsonResponse {
        return $this->jsonResponse(
            ['message' => $message],
            Response::HTTP_FORBIDDEN,
            $headers
        );
    }

    public function serverErrorResponse(
        ?string $message = 'Internal Server Error.',
        array $headers = []
    ): JsonResponse {
        return $this->jsonResponse(
            ['message' => $message],
            Response::HTTP_INTERNAL_SERVER_ERROR,
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
}
