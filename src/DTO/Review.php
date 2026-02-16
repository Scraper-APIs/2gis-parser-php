<?php

declare(strict_types=1);

namespace TwoGisParser\DTO;

final readonly class Review
{
    /**
     * @param  string[]  $placeCategories
     * @param  string[]  $reviewTopics
     * @param  array<string, int>|null  $reactions
     * @param  array<string, mixed>|null  $officialAnswer
     * @param  string[]  $photos
     */
    public function __construct(
        public string $placeId,
        public string $placeName,
        public ?string $placeUrl,
        public ?string $placeAddress,
        public ?string $placeCity,
        public ?float $placeRating,
        public ?int $placeReviewCount,
        public array $placeCategories,
        public array $reviewTopics,
        public string $reviewId,
        public int $rating,
        public ?string $text,
        public ?string $dateCreated,
        public ?string $dateEdited,
        public ?string $authorName,
        public ?string $authorId,
        public ?string $authorPhotoUrl,
        public ?int $authorReviewsCount,
        public ?int $likesCount,
        public ?int $commentsCount,
        public ?array $reactions,
        public ?string $provider,
        public ?array $officialAnswer,
        public array $photos,
        public ?string $searchQuery,
        public ?string $scrapedAt,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            placeId: (string) ($data['placeId'] ?? ''),
            placeName: (string) ($data['placeName'] ?? ''),
            placeUrl: $data['placeUrl'] ?? null,
            placeAddress: $data['placeAddress'] ?? null,
            placeCity: $data['placeCity'] ?? null,
            placeRating: isset($data['placeRating']) ? (float) $data['placeRating'] : null,
            placeReviewCount: isset($data['placeReviewCount']) ? (int) $data['placeReviewCount'] : null,
            placeCategories: $data['placeCategories'] ?? [],
            reviewTopics: $data['reviewTopics'] ?? [],
            reviewId: (string) ($data['reviewId'] ?? ''),
            rating: (int) ($data['rating'] ?? 0),
            text: $data['text'] ?? null,
            dateCreated: $data['dateCreated'] ?? null,
            dateEdited: $data['dateEdited'] ?? null,
            authorName: $data['authorName'] ?? null,
            authorId: $data['authorId'] ?? null,
            authorPhotoUrl: $data['authorPhotoUrl'] ?? null,
            authorReviewsCount: isset($data['authorReviewsCount']) ? (int) $data['authorReviewsCount'] : null,
            likesCount: isset($data['likesCount']) ? (int) $data['likesCount'] : null,
            commentsCount: isset($data['commentsCount']) ? (int) $data['commentsCount'] : null,
            reactions: $data['reactions'] ?? null,
            provider: $data['provider'] ?? null,
            officialAnswer: $data['officialAnswer'] ?? null,
            photos: $data['photos'] ?? [],
            searchQuery: $data['searchQuery'] ?? null,
            scrapedAt: $data['scrapedAt'] ?? null,
        );
    }

    /**
     * Check if the review has an official answer from the business.
     */
    public function hasOfficialAnswer(): bool
    {
        return $this->officialAnswer !== null && count($this->officialAnswer) > 0;
    }

    /**
     * Get the text of the official answer, or null if none.
     */
    public function getOfficialAnswerText(): ?string
    {
        if (! $this->hasOfficialAnswer()) {
            return null;
        }

        return $this->officialAnswer['text'] ?? null;
    }

    /**
     * Check if the review has attached photos.
     */
    public function hasPhotos(): bool
    {
        return count($this->photos) > 0;
    }

    /**
     * Check if the review is positive (4-5 stars).
     */
    public function isPositive(): bool
    {
        return $this->rating >= 4;
    }

    /**
     * Check if the review is negative (1-2 stars).
     */
    public function isNegative(): bool
    {
        return $this->rating <= 2;
    }
}
