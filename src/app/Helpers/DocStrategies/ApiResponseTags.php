<?php

namespace App\Helpers\DocStrategies;

use Knuckles\Camel\Extraction\ExtractedEndpointData;
use Knuckles\Scribe\Extracting\RouteDocBlocker;
use Knuckles\Scribe\Extracting\Strategies\Strategy;
use Mpociot\Reflection\DocBlock\Tag;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseTags extends Strategy
{
    private static array $responseTags = [
        'okResponse' => Response::HTTP_OK,
        'createdResponse' => Response::HTTP_CREATED,
        'failedResponse' => Response::HTTP_BAD_REQUEST,
        'unprocessableResponse' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'notFoundResponse' => Response::HTTP_NOT_FOUND,
        'unauthorizedResponse' => Response::HTTP_UNAUTHORIZED,
        'forbiddenResponse' => Response::HTTP_FORBIDDEN,
        'serverErrorResponse' => Response::HTTP_INTERNAL_SERVER_ERROR,
    ];

    public function __invoke(ExtractedEndpointData $endpointData, array $routeRules = []): ?array
    {
        $docBlocks = RouteDocBlocker::getDocBlocksFromRoute($endpointData->route);
        return $this->getDocBlockResponses($docBlocks['method']->getTags());
    }

    /**
     * Get the response from the docblock if available.
     *
     * @param Tag[] $tags
     *
     * @return array|null
     */
    public function getDocBlockResponses(array $tags): ?array
    {
        $responseTags = array_values(
            array_filter($tags, function ($tag) {
                return $tag instanceof Tag && $this->checkTagExistence($tag);
            })
        );

        if (empty($responseTags)) {
            return null;
        }

        return array_map(function (Tag $tag) {
            return $this->buildTagResponse($tag);
        }, $responseTags);
    }

    private function checkTagExistence(Tag $tag): bool
    {
        return in_array(
            $tag->getName(),
            array_keys(self::$responseTags, true),
            true
        );
    }

    private function buildTagResponse(Tag $tag): array
    {
        $statusCode = self::$responseTags[$tag->getName()] ?? Response::HTTP_BAD_REQUEST;
        return [
            'content' => $this->morphMessage($statusCode),
            'status' => $statusCode,
            'description' => $this->getMessage($statusCode)
        ];
    }

    protected function morphMessage(int $statusCode): string
    {
        return json_encode(['message' => $this->getMessage($statusCode)], JSON_THROW_ON_ERROR);
    }

    protected function getMessage(int $statusCode): string
    {
        return Response::$statusTexts[$statusCode] ?? 'unknown status';
    }
}
