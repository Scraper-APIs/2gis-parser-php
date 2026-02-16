<?php

declare(strict_types=1);

namespace TwoGisParser\DTO;

final readonly class Job
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $categoryId,
        public ?string $categoryName,
        public ?string $salaryLabel,
        public ?string $description,
        public ?string $orgId,
        public ?string $orgName,
        public ?string $branchId,
        public ?string $address,
        public ?string $city,
        public ?string $district,
        public ?string $region,
        public ?float $lat,
        public ?float $lon,
        public ?string $applyUrl,
        public ?string $applyType,
        public ?string $provider,
        public ?string $logoUrl,
        public ?string $scrapedAt,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) ($data['id'] ?? ''),
            name: (string) ($data['name'] ?? ''),
            categoryId: $data['categoryId'] ?? null,
            categoryName: $data['categoryName'] ?? null,
            salaryLabel: $data['salaryLabel'] ?? null,
            description: $data['description'] ?? null,
            orgId: $data['orgId'] ?? null,
            orgName: $data['orgName'] ?? null,
            branchId: $data['branchId'] ?? null,
            address: $data['address'] ?? null,
            city: $data['city'] ?? null,
            district: $data['district'] ?? null,
            region: $data['region'] ?? null,
            lat: isset($data['lat']) ? (float) $data['lat'] : null,
            lon: isset($data['lon']) ? (float) $data['lon'] : null,
            applyUrl: $data['applyUrl'] ?? null,
            applyType: $data['applyType'] ?? null,
            provider: $data['provider'] ?? null,
            logoUrl: $data['logoUrl'] ?? null,
            scrapedAt: $data['scrapedAt'] ?? null,
        );
    }

    /**
     * Check if the job has an apply URL.
     */
    public function hasApplyUrl(): bool
    {
        return $this->applyUrl !== null && $this->applyUrl !== '';
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
}
