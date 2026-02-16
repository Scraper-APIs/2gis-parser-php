<?php

declare(strict_types=1);

namespace TwoGisParser;

final readonly class Config
{
    public const PLACES_ACTOR_ID = 'zen-studio/2gis-places-scraper-api';

    public const REVIEWS_ACTOR_ID = 'zen-studio/2gis-reviews-scraper';

    public const PROPERTY_ACTOR_ID = 'zen-studio/2gis-property-scraper';

    public const JOBS_ACTOR_ID = 'zen-studio/2gis-jobs-scraper';

    public function __construct(
        public string $apiToken,
        public string $baseUrl = 'https://api.apify.com/v2',
        public int $timeout = 900,
    ) {}
}
