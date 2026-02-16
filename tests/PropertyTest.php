<?php

declare(strict_types=1);

use TwoGisParser\DTO\Property;

it('creates property from array', function () {
    $property = Property::fromArray(getSamplePropertyData());

    expect($property->productId)->toBe('prop_12345678')
        ->and($property->name)->toBe('2-room apartment, 65 m2, 8/17 floor')
        ->and($property->categoryName)->toBe('Sale residential')
        ->and($property->propertyType)->toBe('apartment')
        ->and($property->rooms)->toBe(2)
        ->and($property->area)->toBe(65.3)
        ->and($property->floor)->toBe(8)
        ->and($property->price)->toBe(15500000.0)
        ->and($property->currency)->toBe('RUB')
        ->and($property->pricePerSqm)->toBe(237366.0)
        ->and($property->address)->toBe('Leninsky Prospekt, 72/2')
        ->and($property->city)->toBe('Moscow')
        ->and($property->district)->toBe('Gagarinsky')
        ->and($property->lat)->toBe(55.692847)
        ->and($property->lon)->toBe(37.569482)
        ->and($property->provider)->toBe('CIAN')
        ->and($property->isRecent)->toBeTrue()
        ->and($property->images)->toHaveCount(3)
        ->and($property->postcode)->toBe('119261')
        ->and($property->scrapedAt)->toBe('2026-02-15T14:22:00Z');
});

it('checks images availability', function () {
    $property = Property::fromArray(getSamplePropertyData());

    expect($property->hasImages())->toBeTrue();
});

it('gets coordinates', function () {
    $property = Property::fromArray(getSamplePropertyData());

    expect($property->getCoordinates())->toBe(['lat' => 55.692847, 'lng' => 37.569482]);
});

it('formats price with currency', function () {
    $property = Property::fromArray(getSamplePropertyData());

    expect($property->getPriceFormatted())->toBe('15,500,000 RUB');
});

it('handles missing optional fields', function () {
    $minimal = [
        'productId' => 'prop_001',
        'name' => 'Test Property',
    ];

    $property = Property::fromArray($minimal);

    expect($property->productId)->toBe('prop_001')
        ->and($property->name)->toBe('Test Property')
        ->and($property->categoryName)->toBeNull()
        ->and($property->propertyType)->toBeNull()
        ->and($property->rooms)->toBeNull()
        ->and($property->area)->toBeNull()
        ->and($property->floor)->toBeNull()
        ->and($property->price)->toBeNull()
        ->and($property->currency)->toBeNull()
        ->and($property->lat)->toBeNull()
        ->and($property->lon)->toBeNull()
        ->and($property->isRecent)->toBeFalse()
        ->and($property->images)->toBeEmpty()
        ->and($property->scrapedAt)->toBeNull();
});

it('returns null coordinates when lat or lon missing', function () {
    $data = getSamplePropertyData();
    unset($data['lat']);

    $property = Property::fromArray($data);

    expect($property->getCoordinates())->toBeNull();
});

it('returns null for price formatted when price is null', function () {
    $minimal = [
        'productId' => 'prop_001',
        'name' => 'Test Property',
    ];

    $property = Property::fromArray($minimal);

    expect($property->getPriceFormatted())->toBeNull();
});

it('formats price without currency when currency is null', function () {
    $data = getSamplePropertyData();
    $data['currency'] = null;

    $property = Property::fromArray($data);

    expect($property->getPriceFormatted())->toBe('15,500,000');
});

it('returns false for hasImages when no images', function () {
    $minimal = [
        'productId' => 'prop_001',
        'name' => 'Test Property',
    ];

    $property = Property::fromArray($minimal);

    expect($property->hasImages())->toBeFalse();
});
