<?php

namespace App\Helpers\DocStrategies;

use Knuckles\Camel\Extraction\ExtractedEndpointData;
use Knuckles\Scribe\Extracting\RouteDocBlocker;
use Knuckles\Scribe\Extracting\Strategies\Strategy;

class HasPaginationParameters extends Strategy
{
    public function __invoke(ExtractedEndpointData $endpointData, array $routeRules = []): ?array
    {
        $docBlocks = RouteDocBlocker::getDocBlocksFromRoute($endpointData->route);
        $tags = $docBlocks['method']->getTagsByName('usesPagination');

        if (empty($tags)) {
            return [];
        }

        return [
            'page[number]' => [
                'description' => 'Page number to return.',
                'required' => false,
                'example' => 1,
            ],
            'page[size]' => [
                'description' => "Number of items in the page.",
                'required' => false,
                'example' => null, // So it doesn't get included in the examples
            ],
        ];
    }
}
