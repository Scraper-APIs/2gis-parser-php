<?php

declare(strict_types=1);

use TwoGisParser\DTO\Review;

it('creates review from array', function () {
    $review = Review::fromArray(getSampleReviewData());

    expect($review->placeId)->toBe('70000001006391228')
        ->and($review->placeName)->toBe('Pushkin')
        ->and($review->placeUrl)->toBe('https://2gis.ru/moscow/firm/70000001006391228')
        ->and($review->placeAddress)->toBe('Tverskoy Boulevard, 26A')
        ->and($review->placeCity)->toBe('Moscow')
        ->and($review->placeRating)->toBe(4.6)
        ->and($review->placeReviewCount)->toBe(2847)
        ->and($review->placeCategories)->toBe(['Restaurant', 'Banquet hall'])
        ->and($review->reviewTopics)->toBe(['food', 'service', 'atmosphere'])
        ->and($review->reviewId)->toBe('rev_abc123def456')
        ->and($review->rating)->toBe(5)
        ->and($review->text)->toContain('Excellent restaurant')
        ->and($review->dateCreated)->toBe('2026-01-20T18:30:00Z')
        ->and($review->authorName)->toBe('Alexei Petrov')
        ->and($review->authorId)->toBe('user_789012')
        ->and($review->authorReviewsCount)->toBe(45)
        ->and($review->likesCount)->toBe(12)
        ->and($review->commentsCount)->toBe(3)
        ->and($review->provider)->toBe('2gis')
        ->and($review->scrapedAt)->toBe('2026-02-15T14:22:00Z');
});

it('checks official answer presence', function () {
    $review = Review::fromArray(getSampleReviewData());

    expect($review->hasOfficialAnswer())->toBeTrue();
});

it('gets official answer text', function () {
    $review = Review::fromArray(getSampleReviewData());

    expect($review->getOfficialAnswerText())->toBe('Thank you for your kind words, Alexei! We are glad you enjoyed your visit.');
});

it('checks photos presence', function () {
    $review = Review::fromArray(getSampleReviewData());

    expect($review->hasPhotos())->toBeTrue()
        ->and($review->photos)->toHaveCount(2);
});

it('identifies positive review', function () {
    $review = Review::fromArray(getSampleReviewData());

    expect($review->isPositive())->toBeTrue()
        ->and($review->isNegative())->toBeFalse();
});

it('identifies negative review', function () {
    $data = getSampleReviewData();
    $data['rating'] = 1;
    $review = Review::fromArray($data);

    expect($review->isNegative())->toBeTrue()
        ->and($review->isPositive())->toBeFalse();
});

it('identifies neutral review', function () {
    $data = getSampleReviewData();
    $data['rating'] = 3;
    $review = Review::fromArray($data);

    expect($review->isPositive())->toBeFalse()
        ->and($review->isNegative())->toBeFalse();
});

it('handles missing optional fields', function () {
    $minimal = [
        'placeId' => '123',
        'placeName' => 'Test Place',
        'reviewId' => 'rev_001',
        'rating' => 4,
    ];

    $review = Review::fromArray($minimal);

    expect($review->placeId)->toBe('123')
        ->and($review->placeName)->toBe('Test Place')
        ->and($review->reviewId)->toBe('rev_001')
        ->and($review->rating)->toBe(4)
        ->and($review->placeUrl)->toBeNull()
        ->and($review->placeAddress)->toBeNull()
        ->and($review->text)->toBeNull()
        ->and($review->dateCreated)->toBeNull()
        ->and($review->dateEdited)->toBeNull()
        ->and($review->authorName)->toBeNull()
        ->and($review->authorId)->toBeNull()
        ->and($review->officialAnswer)->toBeNull()
        ->and($review->provider)->toBeNull()
        ->and($review->placeCategories)->toBeEmpty()
        ->and($review->reviewTopics)->toBeEmpty()
        ->and($review->photos)->toBeEmpty();
});

it('returns null for official answer when not present', function () {
    $data = getSampleReviewData();
    $data['officialAnswer'] = null;
    $review = Review::fromArray($data);

    expect($review->hasOfficialAnswer())->toBeFalse()
        ->and($review->getOfficialAnswerText())->toBeNull();
});

it('returns false for hasPhotos when no photos', function () {
    $data = getSampleReviewData();
    $data['photos'] = [];
    $review = Review::fromArray($data);

    expect($review->hasPhotos())->toBeFalse();
});
