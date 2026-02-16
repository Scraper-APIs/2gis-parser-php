<?php

declare(strict_types=1);

use TwoGisParser\Config;

it('has correct default values', function () {
    $config = new Config('test_api_token');

    expect($config->apiToken)->toBe('test_api_token')
        ->and($config->placesActorId)->toBe('zen-studio/2gis-places-scraper-api')
        ->and($config->reviewsActorId)->toBe('zen-studio/2gis-reviews-scraper')
        ->and($config->propertyActorId)->toBe('zen-studio/2gis-property-scraper')
        ->and($config->jobsActorId)->toBe('zen-studio/2gis-jobs-scraper')
        ->and($config->baseUrl)->toBe('https://api.apify.com/v2')
        ->and($config->timeout)->toBe(900);
});

it('accepts custom values', function () {
    $config = new Config(
        apiToken: 'custom_token',
        placesActorId: 'custom/places-actor',
        reviewsActorId: 'custom/reviews-actor',
        propertyActorId: 'custom/property-actor',
        jobsActorId: 'custom/jobs-actor',
        baseUrl: 'https://custom.api.com/v2',
        timeout: 600,
    );

    expect($config->apiToken)->toBe('custom_token')
        ->and($config->placesActorId)->toBe('custom/places-actor')
        ->and($config->reviewsActorId)->toBe('custom/reviews-actor')
        ->and($config->propertyActorId)->toBe('custom/property-actor')
        ->and($config->jobsActorId)->toBe('custom/jobs-actor')
        ->and($config->baseUrl)->toBe('https://custom.api.com/v2')
        ->and($config->timeout)->toBe(600);
});
