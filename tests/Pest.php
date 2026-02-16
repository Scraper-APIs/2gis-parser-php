<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
*/

// Uses default TestCase

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

function getSamplePlaceData(): array
{
    return [
        'id' => '70000001006391228',
        'name' => 'Pushkin',
        'fullName' => 'Pushkin, restaurant',
        'extension' => 'restaurant',
        'url' => 'https://2gis.ru/moscow/firm/70000001006391228',
        'categories' => ['Restaurant', 'Banquet hall'],
        'categoryIds' => ['restaurant', 'banquet_hall'],
        'poiCategory' => 'food',
        'rating' => 4.6,
        'reviewCount' => 2847,
        'ratingCount' => 3150,
        'reviewProviders' => [
            ['name' => '2gis', 'count' => 1523],
            ['name' => 'flamp', 'count' => 1324],
        ],
        'summary' => 'Famous Russian cuisine restaurant in a historic mansion',
        'description' => 'Restaurant Pushkin occupies a baroque mansion on Tverskoy Boulevard, offering traditional Russian cuisine in an elegant setting.',
        'badges' => ['verified' => true, 'premium' => false],
        'address' => 'Tverskoy Boulevard, 26A',
        'fullAddress' => 'Russia, Moscow, Tverskoy Boulevard, 26A',
        'addressComment' => 'Entrance from the courtyard',
        'postcode' => '125009',
        'country' => 'Russia',
        'region' => 'Moscow',
        'city' => 'Moscow',
        'district' => 'Tverskoy',
        'street' => 'Tverskoy Boulevard',
        'houseNumber' => '26A',
        'latitude' => 55.764353,
        'longitude' => 37.600312,
        'timezoneOffset' => 180,
        'mainPhotoUrl' => 'https://cdn.2gis.com/photos/pushkin-main.jpg',
        'photoCount' => 245,
        'schedule' => [
            'Mon' => ['from' => '12:00', 'to' => '00:00'],
            'Tue' => ['from' => '12:00', 'to' => '00:00'],
        ],
        'isClosed' => false,
        'nearestStations' => [
            ['name' => 'Pushkinskaya', 'distance' => 150, 'line' => 'Tagansko-Krasnopresnenskaya'],
        ],
        'phones' => ['+74955992664', '+74959999870'],
        'phonesFormatted' => ['+7 (495) 599-26-64', '+7 (495) 999-98-70'],
        'emails' => ['info@cafe-pushkin.ru'],
        'website' => 'https://cafe-pushkin.ru',
        'socials' => ['instagram' => 'cafe_pushkin', 'facebook' => 'cafepushkin'],
        'orgName' => 'Maison Dellos',
        'orgId' => '70000001006391000',
        'orgBranchCount' => 12,
        'orgRating' => 4.4,
        'orgReviewCount' => 8500,
        'brand' => 'Cafe Pushkin',
        'isPromoted' => false,
        'hasGoods' => false,
        'hasDiscount' => true,
        'delivery' => ['available' => true, 'services' => ['Yandex Eda', 'Delivery Club']],
        'replyRate' => 0.85,
        'floorCount' => 3,
        'yearBuilt' => 1899,
        'buildingMaterial' => 'brick',
        'attributes' => [
            ['name' => 'Wi-Fi', 'value' => true],
            ['name' => 'Card payment', 'value' => true],
        ],
        'attributeGroups' => [
            ['name' => 'Services', 'attributes' => ['Wi-Fi', 'Card payment', 'Reservation']],
        ],
        'createdAt' => '2015-03-10T12:00:00Z',
        'updatedAt' => '2026-02-10T08:30:00Z',
        'searchQuery' => 'restaurant',
        'scrapedAt' => '2026-02-15T14:22:00Z',
        'reviews' => [
            ['reviewId' => 'r1', 'rating' => 5, 'text' => 'Amazing food and atmosphere'],
        ],
        'photos' => [
            ['url' => 'https://cdn.2gis.com/photos/pushkin-1.jpg', 'category' => 'interior'],
        ],
    ];
}

function getSampleReviewData(): array
{
    return [
        'placeId' => '70000001006391228',
        'placeName' => 'Pushkin',
        'placeUrl' => 'https://2gis.ru/moscow/firm/70000001006391228',
        'placeAddress' => 'Tverskoy Boulevard, 26A',
        'placeCity' => 'Moscow',
        'placeRating' => 4.6,
        'placeReviewCount' => 2847,
        'placeCategories' => ['Restaurant', 'Banquet hall'],
        'reviewTopics' => ['food', 'service', 'atmosphere'],
        'reviewId' => 'rev_abc123def456',
        'rating' => 5,
        'text' => 'Excellent restaurant with stunning interior. The borsch was outstanding and the service was impeccable.',
        'dateCreated' => '2026-01-20T18:30:00Z',
        'dateEdited' => null,
        'authorName' => 'Alexei Petrov',
        'authorId' => 'user_789012',
        'authorPhotoUrl' => 'https://cdn.2gis.com/avatars/user789.jpg',
        'authorReviewsCount' => 45,
        'likesCount' => 12,
        'commentsCount' => 3,
        'reactions' => ['like' => 12, 'dislike' => 1],
        'provider' => '2gis',
        'officialAnswer' => [
            'text' => 'Thank you for your kind words, Alexei! We are glad you enjoyed your visit.',
            'date' => '2026-01-21T10:00:00Z',
            'authorName' => 'Restaurant Manager',
        ],
        'photos' => [
            'https://cdn.2gis.com/reviews/photo1.jpg',
            'https://cdn.2gis.com/reviews/photo2.jpg',
        ],
        'searchQuery' => 'restaurant Moscow',
        'scrapedAt' => '2026-02-15T14:22:00Z',
    ];
}

function getSamplePropertyData(): array
{
    return [
        'productId' => 'prop_12345678',
        'name' => '2-room apartment, 65 m2, 8/17 floor',
        'categoryName' => 'Sale residential',
        'propertyType' => 'apartment',
        'rooms' => 2,
        'area' => 65.3,
        'floor' => 8,
        'price' => 15500000.0,
        'currency' => 'RUB',
        'pricePerSqm' => 237366.0,
        'address' => 'Leninsky Prospekt, 72/2',
        'city' => 'Moscow',
        'district' => 'Gagarinsky',
        'region' => 'Moscow',
        'country' => 'Russia',
        'lat' => 55.692847,
        'lon' => 37.569482,
        'provider' => 'CIAN',
        'listingUrl' => 'https://2gis.ru/moscow/realty/prop_12345678',
        'isRecent' => true,
        'images' => [
            'https://cdn.2gis.com/realty/photo1.jpg',
            'https://cdn.2gis.com/realty/photo2.jpg',
            'https://cdn.2gis.com/realty/photo3.jpg',
        ],
        'nearestStations' => [
            ['name' => 'Leninsky Prospekt', 'distance' => 350, 'line' => 'Kaluzhsko-Rizhskaya'],
        ],
        'description' => 'Spacious 2-room apartment with renovated kitchen and bathroom. South-facing windows with park view.',
        'categoryId' => 'sale_residential',
        'providerBranchId' => 'branch_001',
        'providerOrgId' => 'org_cian_001',
        'buildingId' => 'bld_555777',
        'postcode' => '119261',
        'scrapedAt' => '2026-02-15T14:22:00Z',
    ];
}

function getSampleJobData(): array
{
    return [
        'id' => 'job_98765432',
        'name' => 'PHP Developer (Senior)',
        'categoryId' => 'it_development',
        'categoryName' => 'IT, Development',
        'salaryLabel' => '250,000 - 400,000 RUB',
        'description' => 'We are looking for a Senior PHP Developer to join our team. Requirements: PHP 8+, Laravel, PostgreSQL, Docker.',
        'orgId' => 'org_yandex_001',
        'orgName' => 'Yandex',
        'branchId' => 'branch_yandex_spb',
        'address' => 'Piskarevsky Prospekt, 2',
        'city' => 'Saint Petersburg',
        'district' => 'Kalininsky',
        'region' => 'Saint Petersburg',
        'lat' => 59.967743,
        'lon' => 30.381665,
        'applyUrl' => 'https://yandex.ru/jobs/vacancies/php-senior',
        'applyType' => 'external',
        'provider' => '2gis',
        'logoUrl' => 'https://cdn.2gis.com/logos/yandex.png',
        'scrapedAt' => '2026-02-15T14:22:00Z',
    ];
}
