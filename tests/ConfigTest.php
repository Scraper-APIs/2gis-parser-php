<?php

declare(strict_types=1);

use TwoGisParser\Config;

it('has correct default values', function () {
    $config = new Config('test_api_token');

    expect($config->apiToken)->toBe('test_api_token')
        ->and($config->baseUrl)->toBe('https://api.apify.com/v2')
        ->and($config->timeout)->toBe(900);
});

it('accepts custom values', function () {
    $config = new Config(
        apiToken: 'custom_token',
        baseUrl: 'https://custom.api.com/v2',
        timeout: 600,
    );

    expect($config->apiToken)->toBe('custom_token')
        ->and($config->baseUrl)->toBe('https://custom.api.com/v2')
        ->and($config->timeout)->toBe(600);
});

it('has hardcoded actor IDs', function () {
    expect(Config::PLACES_ACTOR_ID)->toBe('zen-studio/2gis-places-scraper-api')
        ->and(Config::REVIEWS_ACTOR_ID)->toBe('zen-studio/2gis-reviews-scraper')
        ->and(Config::PROPERTY_ACTOR_ID)->toBe('zen-studio/2gis-property-scraper')
        ->and(Config::JOBS_ACTOR_ID)->toBe('zen-studio/2gis-jobs-scraper');
});
