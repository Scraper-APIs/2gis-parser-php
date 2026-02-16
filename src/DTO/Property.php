<?php

declare(strict_types=1);

namespace TwoGisParser\DTO;

final readonly class Property
{
    /**
     * @param  string[]  $images
     * @param  array<int, mixed>|null  $nearestStations
     */
    public function __construct(
        public string $productId,
        public string $name,
        public ?string $categoryName,
        public ?string $propertyType,
        public ?int $rooms,
        public ?float $area,
        public ?int $floor,
        public ?float $price,
        public ?string $currency,
        public ?float $pricePerSqm,
        public ?string $address,
        public ?string $city,
        public ?string $district,
        public ?string $region,
        public ?string $country,
        public ?float $lat,
        public ?float $lon,
        public ?string $provider,
        public ?string $listingUrl,
        public bool $isRecent,
        public array $images,
        public ?array $nearestStations,
        public ?string $description,
        public ?string $categoryId,
        public ?string $providerBranchId,
        public ?string $providerOrgId,
        public ?string $buildingId,
        public ?string $postcode,
        public ?string $scrapedAt,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            productId: (string) ($data['productId'] ?? ''),
            name: (string) ($data['name'] ?? ''),
            categoryName: $data['categoryName'] ?? null,
            propertyType: $data['propertyType'] ?? null,
            rooms: isset($data['rooms']) ? (int) $data['rooms'] : null,
            area: isset($data['area']) ? (float) $data['area'] : null,
            floor: isset($data['floor']) ? (int) $data['floor'] : null,
            price: isset($data['price']) ? (float) $data['price'] : null,
            currency: $data['currency'] ?? null,
            pricePerSqm: isset($data['pricePerSqm']) ? (float) $data['pricePerSqm'] : null,
            address: $data['address'] ?? null,
            city: $data['city'] ?? null,
            district: $data['district'] ?? null,
            region: $data['region'] ?? null,
            country: $data['country'] ?? null,
            lat: isset($data['lat']) ? (float) $data['lat'] : null,
            lon: isset($data['lon']) ? (float) $data['lon'] : null,
            provider: $data['provider'] ?? null,
            listingUrl: $data['listingUrl'] ?? null,
            isRecent: $data['isRecent'] ?? false,
            images: $data['images'] ?? [],
            nearestStations: $data['nearestStations'] ?? null,
            description: $data['description'] ?? null,
            categoryId: $data['categoryId'] ?? null,
            providerBranchId: $data['providerBranchId'] ?? null,
            providerOrgId: $data['providerOrgId'] ?? null,
            buildingId: $data['buildingId'] ?? null,
            postcode: $data['postcode'] ?? null,
            scrapedAt: $data['scrapedAt'] ?? null,
        );
    }

    /**
     * Check if the property listing has images.
     */
    public function hasImages(): bool
    {
        return count($this->images) > 0;
    }

    /**
     * Get coordinates as an associative array, or null if not available.
     *
     * @return array{lat: float, lng: float}|null
     */
    public function getCoordinates(): ?array
    {
        if ($this->lat === null || $this->lon === null) {
            return null;
        }

        return ['lat' => $this->lat, 'lng' => $this->lon];
    }

    /**
     * Get price formatted with currency, or null if not available.
     */
    public function getPriceFormatted(): ?string
    {
        if ($this->price === null) {
            return null;
        }

        $formatted = number_format($this->price, 0, '.', ',');

        return $this->currency !== null ? "{$formatted} {$this->currency}" : $formatted;
    }
}
