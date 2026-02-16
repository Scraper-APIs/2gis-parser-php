<?php

declare(strict_types=1);

use TwoGisParser\DTO\Job;

it('creates job from array', function () {
    $job = Job::fromArray(getSampleJobData());

    expect($job->id)->toBe('job_98765432')
        ->and($job->name)->toBe('PHP Developer (Senior)')
        ->and($job->categoryId)->toBe('it_development')
        ->and($job->categoryName)->toBe('IT, Development')
        ->and($job->salaryLabel)->toBe('250,000 - 400,000 RUB')
        ->and($job->description)->toContain('Senior PHP Developer')
        ->and($job->orgId)->toBe('org_yandex_001')
        ->and($job->orgName)->toBe('Yandex')
        ->and($job->branchId)->toBe('branch_yandex_spb')
        ->and($job->address)->toBe('Piskarevsky Prospekt, 2')
        ->and($job->city)->toBe('Saint Petersburg')
        ->and($job->district)->toBe('Kalininsky')
        ->and($job->region)->toBe('Saint Petersburg')
        ->and($job->lat)->toBe(59.967743)
        ->and($job->lon)->toBe(30.381665)
        ->and($job->applyUrl)->toBe('https://yandex.ru/jobs/vacancies/php-senior')
        ->and($job->applyType)->toBe('external')
        ->and($job->provider)->toBe('2gis')
        ->and($job->logoUrl)->toBe('https://cdn.2gis.com/logos/yandex.png')
        ->and($job->scrapedAt)->toBe('2026-02-15T14:22:00Z');
});

it('checks apply url availability', function () {
    $job = Job::fromArray(getSampleJobData());

    expect($job->hasApplyUrl())->toBeTrue();
});

it('gets coordinates', function () {
    $job = Job::fromArray(getSampleJobData());

    expect($job->getCoordinates())->toBe(['lat' => 59.967743, 'lng' => 30.381665]);
});

it('handles missing optional fields', function () {
    $minimal = [
        'id' => 'job_001',
        'name' => 'Test Job',
    ];

    $job = Job::fromArray($minimal);

    expect($job->id)->toBe('job_001')
        ->and($job->name)->toBe('Test Job')
        ->and($job->categoryId)->toBeNull()
        ->and($job->categoryName)->toBeNull()
        ->and($job->salaryLabel)->toBeNull()
        ->and($job->description)->toBeNull()
        ->and($job->orgId)->toBeNull()
        ->and($job->orgName)->toBeNull()
        ->and($job->branchId)->toBeNull()
        ->and($job->address)->toBeNull()
        ->and($job->city)->toBeNull()
        ->and($job->lat)->toBeNull()
        ->and($job->lon)->toBeNull()
        ->and($job->applyUrl)->toBeNull()
        ->and($job->applyType)->toBeNull()
        ->and($job->provider)->toBeNull()
        ->and($job->logoUrl)->toBeNull()
        ->and($job->scrapedAt)->toBeNull();
});

it('returns false for hasApplyUrl when url is null', function () {
    $minimal = [
        'id' => 'job_001',
        'name' => 'Test Job',
    ];

    $job = Job::fromArray($minimal);

    expect($job->hasApplyUrl())->toBeFalse();
});

it('returns false for hasApplyUrl when url is empty string', function () {
    $data = getSampleJobData();
    $data['applyUrl'] = '';

    $job = Job::fromArray($data);

    expect($job->hasApplyUrl())->toBeFalse();
});

it('returns null coordinates when lat or lon missing', function () {
    $data = getSampleJobData();
    unset($data['lat']);

    $job = Job::fromArray($data);

    expect($job->getCoordinates())->toBeNull();
});
