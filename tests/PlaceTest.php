<?php

declare(strict_types=1);

use TwoGisParser\DTO\Place;

it('creates place from array', function () {
    $place = Place::fromArray(getSamplePlaceData());

    expect($place->id)->toBe('70000001006391228')
        ->and($place->name)->toBe('Pushkin')
        ->and($place->fullName)->toBe('Pushkin, restaurant')
        ->and($place->extension)->toBe('restaurant')
        ->and($place->url)->toBe('https://2gis.ru/moscow/firm/70000001006391228')
        ->and($place->categories)->toBe(['Restaurant', 'Banquet hall'])
        ->and($place->categoryIds)->toBe(['restaurant', 'banquet_hall'])
        ->and($place->poiCategory)->toBe('food')
        ->and($place->rating)->toBe(4.6)
        ->and($place->reviewCount)->toBe(2847)
        ->and($place->ratingCount)->toBe(3150)
        ->and($place->address)->toBe('Tverskoy Boulevard, 26A')
        ->and($place->fullAddress)->toBe('Russia, Moscow, Tverskoy Boulevard, 26A')
        ->and($place->city)->toBe('Moscow')
        ->and($place->latitude)->toBe(55.764353)
        ->and($place->longitude)->toBe(37.600312)
        ->and($place->isClosed)->toBeFalse()
        ->and($place->website)->toBe('https://cafe-pushkin.ru')
        ->and($place->orgName)->toBe('Maison Dellos')
        ->and($place->isPromoted)->toBeFalse()
        ->and($place->hasGoods)->toBeFalse()
        ->and($place->hasDiscount)->toBeTrue()
        ->and($place->yearBuilt)->toBe(1899)
        ->and($place->scrapedAt)->toBe('2026-02-15T14:22:00Z');
});

it('checks contact info availability', function () {
    $place = Place::fromArray(getSamplePlaceData());

    expect($place->hasContactInfo())->toBeTrue();
});

it('gets first phone number', function () {
    $place = Place::fromArray(getSamplePlaceData());

    expect($place->getFirstPhone())->toBe('+74955992664');
});

it('gets first email address', function () {
    $place = Place::fromArray(getSamplePlaceData());

    expect($place->getFirstEmail())->toBe('info@cafe-pushkin.ru');
});

it('checks website availability', function () {
    $place = Place::fromArray(getSamplePlaceData());

    expect($place->hasWebsite())->toBeTrue();
});

it('gets coordinates', function () {
    $place = Place::fromArray(getSamplePlaceData());

    expect($place->getCoordinates())->toBe(['lat' => 55.764353, 'lng' => 37.600312]);
});

it('handles missing optional fields', function () {
    $minimal = [
        'id' => '123',
        'name' => 'Test Place',
    ];

    $place = Place::fromArray($minimal);

    expect($place->id)->toBe('123')
        ->and($place->name)->toBe('Test Place')
        ->and($place->fullName)->toBeNull()
        ->and($place->extension)->toBeNull()
        ->and($place->url)->toBeNull()
        ->and($place->rating)->toBeNull()
        ->and($place->reviewCount)->toBeNull()
        ->and($place->address)->toBeNull()
        ->and($place->latitude)->toBeNull()
        ->and($place->longitude)->toBeNull()
        ->and($place->website)->toBeNull()
        ->and($place->isClosed)->toBeFalse()
        ->and($place->isPromoted)->toBeFalse()
        ->and($place->hasGoods)->toBeFalse()
        ->and($place->hasDiscount)->toBeFalse()
        ->and($place->scrapedAt)->toBeNull();
});

it('handles empty arrays for phones emails and categories', function () {
    $minimal = [
        'id' => '123',
        'name' => 'Test Place',
    ];

    $place = Place::fromArray($minimal);

    expect($place->phones)->toBeEmpty()
        ->and($place->phonesFormatted)->toBeEmpty()
        ->and($place->emails)->toBeEmpty()
        ->and($place->categories)->toBeEmpty()
        ->and($place->categoryIds)->toBeEmpty()
        ->and($place->reviews)->toBeEmpty()
        ->and($place->photos)->toBeEmpty();
});

it('returns null for contact info when no phones or emails', function () {
    $minimal = [
        'id' => '123',
        'name' => 'Test Place',
    ];

    $place = Place::fromArray($minimal);

    expect($place->hasContactInfo())->toBeFalse()
        ->and($place->getFirstPhone())->toBeNull()
        ->and($place->getFirstEmail())->toBeNull();
});

it('returns null coordinates when latitude or longitude missing', function () {
    $data = getSamplePlaceData();
    unset($data['latitude']);

    $place = Place::fromArray($data);

    expect($place->getCoordinates())->toBeNull();
});

it('returns false for hasWebsite when website is null', function () {
    $data = getSamplePlaceData();
    $data['website'] = null;

    $place = Place::fromArray($data);

    expect($place->hasWebsite())->toBeFalse();
});
