<?php

declare(strict_types=1);

namespace TwoGisParser\DTO;

final readonly class Place
{
    /**
     * @param  string[]  $categories
     * @param  string[]  $categoryIds
     * @param  array<int, mixed>|null  $reviewProviders
     * @param  array<string, mixed>|null  $badges
     * @param  array<string, mixed>|null  $schedule
     * @param  array<int, mixed>|null  $nearestStations
     * @param  string[]  $phones
     * @param  string[]  $phonesFormatted
     * @param  string[]  $emails
     * @param  array<string, string>|null  $socials
     * @param  array<string, mixed>|null  $delivery
     * @param  array<int, mixed>|null  $attributes
     * @param  array<int, mixed>|null  $attributeGroups
     * @param  array<int, mixed>  $reviews
     * @param  array<int, mixed>  $photos
     */
    public function __construct(
        public string $id,
        public string $name,
        public ?string $fullName,
        public ?string $extension,
        public ?string $url,
        public array $categories,
        public array $categoryIds,
        public ?string $poiCategory,
        public ?float $rating,
        public ?int $reviewCount,
        public ?int $ratingCount,
        public ?array $reviewProviders,
        public ?string $summary,
        public ?string $description,
        public ?array $badges,
        public ?string $address,
        public ?string $fullAddress,
        public ?string $addressComment,
        public ?string $postcode,
        public ?string $country,
        public ?string $region,
        public ?string $city,
        public ?string $district,
        public ?string $street,
        public ?string $houseNumber,
        public ?float $latitude,
        public ?float $longitude,
        public ?int $timezoneOffset,
        public ?string $mainPhotoUrl,
        public ?int $photoCount,
        public ?array $schedule,
        public bool $isClosed,
        public ?array $nearestStations,
        public array $phones,
        public array $phonesFormatted,
        public array $emails,
        public ?string $website,
        public ?array $socials,
        public ?string $orgName,
        public ?string $orgId,
        public ?int $orgBranchCount,
        public ?float $orgRating,
        public ?int $orgReviewCount,
        public ?string $brand,
        public bool $isPromoted,
        public bool $hasGoods,
        public bool $hasDiscount,
        public ?array $delivery,
        public ?float $replyRate,
        public ?int $floorCount,
        public ?int $yearBuilt,
        public ?string $buildingMaterial,
        public ?array $attributes,
        public ?array $attributeGroups,
        public ?string $createdAt,
        public ?string $updatedAt,
        public ?string $searchQuery,
        public ?string $scrapedAt,
        public array $reviews,
        public array $photos,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) ($data['id'] ?? ''),
            name: (string) ($data['name'] ?? ''),
            fullName: $data['fullName'] ?? null,
            extension: $data['extension'] ?? null,
            url: $data['url'] ?? null,
            categories: $data['categories'] ?? [],
            categoryIds: $data['categoryIds'] ?? [],
            poiCategory: $data['poiCategory'] ?? null,
            rating: isset($data['rating']) ? (float) $data['rating'] : null,
            reviewCount: isset($data['reviewCount']) ? (int) $data['reviewCount'] : null,
            ratingCount: isset($data['ratingCount']) ? (int) $data['ratingCount'] : null,
            reviewProviders: $data['reviewProviders'] ?? null,
            summary: $data['summary'] ?? null,
            description: $data['description'] ?? null,
            badges: $data['badges'] ?? null,
            address: $data['address'] ?? null,
            fullAddress: $data['fullAddress'] ?? null,
            addressComment: $data['addressComment'] ?? null,
            postcode: $data['postcode'] ?? null,
            country: $data['country'] ?? null,
            region: $data['region'] ?? null,
            city: $data['city'] ?? null,
            district: $data['district'] ?? null,
            street: $data['street'] ?? null,
            houseNumber: $data['houseNumber'] ?? null,
            latitude: isset($data['latitude']) ? (float) $data['latitude'] : null,
            longitude: isset($data['longitude']) ? (float) $data['longitude'] : null,
            timezoneOffset: isset($data['timezoneOffset']) ? (int) $data['timezoneOffset'] : null,
            mainPhotoUrl: $data['mainPhotoUrl'] ?? null,
            photoCount: isset($data['photoCount']) ? (int) $data['photoCount'] : null,
            schedule: $data['schedule'] ?? null,
            isClosed: $data['isClosed'] ?? false,
            nearestStations: $data['nearestStations'] ?? null,
            phones: $data['phones'] ?? [],
            phonesFormatted: $data['phonesFormatted'] ?? [],
            emails: $data['emails'] ?? [],
            website: $data['website'] ?? null,
            socials: $data['socials'] ?? null,
            orgName: $data['orgName'] ?? null,
            orgId: $data['orgId'] ?? null,
            orgBranchCount: isset($data['orgBranchCount']) ? (int) $data['orgBranchCount'] : null,
            orgRating: isset($data['orgRating']) ? (float) $data['orgRating'] : null,
            orgReviewCount: isset($data['orgReviewCount']) ? (int) $data['orgReviewCount'] : null,
            brand: $data['brand'] ?? null,
            isPromoted: $data['isPromoted'] ?? false,
            hasGoods: $data['hasGoods'] ?? false,
            hasDiscount: $data['hasDiscount'] ?? false,
            delivery: $data['delivery'] ?? null,
            replyRate: isset($data['replyRate']) ? (float) $data['replyRate'] : null,
            floorCount: isset($data['floorCount']) ? (int) $data['floorCount'] : null,
            yearBuilt: isset($data['yearBuilt']) ? (int) $data['yearBuilt'] : null,
            buildingMaterial: $data['buildingMaterial'] ?? null,
            attributes: $data['attributes'] ?? null,
            attributeGroups: $data['attributeGroups'] ?? null,
            createdAt: $data['createdAt'] ?? null,
            updatedAt: $data['updatedAt'] ?? null,
            searchQuery: $data['searchQuery'] ?? null,
            scrapedAt: $data['scrapedAt'] ?? null,
            reviews: $data['reviews'] ?? [],
            photos: $data['photos'] ?? [],
        );
    }

    /**
     * Check if the place has any contact information (phones or emails).
     */
    public function hasContactInfo(): bool
    {
        return count($this->phones) > 0 || count($this->emails) > 0;
    }

    /**
     * Get the first phone number, or null if none available.
     */
    public function getFirstPhone(): ?string
    {
        return $this->phones[0] ?? null;
    }

    /**
     * Get the first email address, or null if none available.
     */
    public function getFirstEmail(): ?string
    {
        return $this->emails[0] ?? null;
    }

    /**
     * Check if the place has a website.
     */
    public function hasWebsite(): bool
    {
        return $this->website !== null && $this->website !== '';
    }

    /**
     * Get coordinates as an associative array, or null if not available.
     *
     * @return array{lat: float, lng: float}|null
     */
    public function getCoordinates(): ?array
    {
        if ($this->latitude === null || $this->longitude === null) {
            return null;
        }

        return ['lat' => $this->latitude, 'lng' => $this->longitude];
    }
}
