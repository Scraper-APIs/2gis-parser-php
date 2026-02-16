<?php

declare(strict_types=1);

namespace TwoGisParser;

final readonly class Config
{
    public function __construct(
        public string $apiToken,
        public string $placesActorId = 'zen-studio/2gis-places-scraper-api',
        public string $reviewsActorId = 'zen-studio/2gis-reviews-scraper',
        public string $propertyActorId = 'zen-studio/2gis-property-scraper',
        public string $jobsActorId = 'zen-studio/2gis-jobs-scraper',
        public string $baseUrl = 'https://api.apify.com/v2',
        public int $timeout = 900,
    ) {}
}
