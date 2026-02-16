<?php

declare(strict_types=1);

namespace TwoGisParser;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use TwoGisParser\DTO\Job;
use TwoGisParser\DTO\Place;
use TwoGisParser\DTO\Property;
use TwoGisParser\DTO\Review;
use TwoGisParser\Exception\ApiException;
use TwoGisParser\Exception\RateLimitException;

final class Client
{
    private HttpClient $http;

    private Config $config;

    public function __construct(string $apiToken, ?Config $config = null)
    {
        $this->config = $config ?? new Config($apiToken);
        $this->http = new HttpClient([
            'base_uri' => $this->config->baseUrl,
            'timeout' => $this->config->timeout,
            'headers' => [
                'Authorization' => 'Bearer '.$this->config->apiToken,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Scrape places/businesses from 2GIS catalog.
     *
     * @param  string[]  $query  Search queries
     * @param  array<string, mixed>  $options  Optional filters (categoryFilter, filterRating, sortBy, filterWebsite, skipClosedPlaces, searchMatching, filterHasPhotos, filter24h, filterNewPlaces, filterDelivery, filterTakeaway, filterCardPayment, filterWifi, filterHasGoods, filterAvgPriceMin, filterAvgPriceMax, maxReviews, reviewsRating, reviewsWithAnswer, reviewsStartDate, reviewsTopic, reviewsFilterKeyword, reviewsSource, maxPhotos, photoCategories, scrapeOrgBranches)
     * @return Place[]
     *
     * @throws ApiException
     * @throws RateLimitException
     */
    public function scrapePlaces(
        array $query = ['restaurant'],
        string $location = 'Moscow',
        int $maxResults = 100,
        Language $language = Language::Auto,
        Country $country = Country::Auto,
        array $options = [],
    ): array {
        $input = [
            'query' => $query,
            'location' => $location,
            'maxResults' => $maxResults,
        ];

        if ($language !== Language::Auto) {
            $input['language'] = $language->value;
        }

        if ($country !== Country::Auto) {
            $input['country'] = $country->value;
        }

        $input = array_merge($input, $options);

        try {
            $items = $this->runActor($this->config->placesActorId, $input);

            return array_map(
                static fn (array $item): Place => Place::fromArray($item),
                $items
            );
        } catch (GuzzleException $e) {
            $this->handleGuzzleException($e);
        }
    }

    /**
     * Scrape reviews from 2GIS places.
     *
     * @param  string[]  $startUrls  2GIS place URLs, search URLs, or branch IDs
     * @param  array<string, mixed>  $options  Optional (reviewsWithAnswer, reviewsStartDate, reviewsTopic, reviewsFilterKeyword)
     * @return Review[]
     *
     * @throws ApiException
     * @throws RateLimitException
     */
    public function scrapeReviews(
        array $startUrls,
        int $maxReviews = 5000,
        int $maxPlaces = 100,
        Language $language = Language::Auto,
        ReviewsRating $reviewsRating = ReviewsRating::All,
        ReviewsSource $reviewsSource = ReviewsSource::All,
        array $options = [],
    ): array {
        $input = [
            'startUrls' => $startUrls,
            'maxReviews' => $maxReviews,
            'maxPlaces' => $maxPlaces,
        ];

        if ($language !== Language::Auto) {
            $input['language'] = $language->value;
        }

        if ($reviewsRating !== ReviewsRating::All) {
            $input['reviewsRating'] = $reviewsRating->value;
        }

        if ($reviewsSource !== ReviewsSource::All) {
            $input['reviewsSource'] = $reviewsSource->value;
        }

        $input = array_merge($input, $options);

        try {
            $items = $this->runActor($this->config->reviewsActorId, $input);

            return array_map(
                static fn (array $item): Review => Review::fromArray($item),
                $items
            );
        } catch (GuzzleException $e) {
            $this->handleGuzzleException($e);
        }
    }

    /**
     * Scrape property listings from 2GIS.
     *
     * @param  array<string, mixed>  $options  Optional (rooms, propertyType, newBuilding, priceMin, priceMax, pricePerMeterMin, pricePerMeterMax, areaMin, areaMax, floorMin, floorMax, notFirstFloor, notLastFloor, floorsInBuildingMin, floorsInBuildingMax, metroTime, provider)
     * @return Property[]
     *
     * @throws ApiException
     * @throws RateLimitException
     */
    public function scrapeProperties(
        string $location = 'Moscow',
        int $maxResults = 1000,
        PropertyCategory $category = PropertyCategory::SaleResidential,
        Language $language = Language::Russian,
        Country $country = Country::Auto,
        PropertySort $sort = PropertySort::Default,
        array $options = [],
    ): array {
        $input = [
            'location' => $location,
            'maxResults' => $maxResults,
            'category' => $category->value,
        ];

        if ($language !== Language::Auto) {
            $input['language'] = $language->value;
        }

        if ($country !== Country::Auto) {
            $input['country'] = $country->value;
        }

        if ($sort !== PropertySort::Default) {
            $input['sort'] = $sort->value;
        }

        $input = array_merge($input, $options);

        try {
            $items = $this->runActor($this->config->propertyActorId, $input);

            return array_map(
                static fn (array $item): Property => Property::fromArray($item),
                $items
            );
        } catch (GuzzleException $e) {
            $this->handleGuzzleException($e);
        }
    }

    /**
     * Scrape job vacancies from 2GIS.
     *
     * @return Job[]
     *
     * @throws ApiException
     * @throws RateLimitException
     */
    public function scrapeJobs(
        string $location = 'Saint Petersburg',
        int $maxResults = 1000,
        Language $language = Language::Russian,
        Country $country = Country::Auto,
        string $categoryId = '',
        ?int $salaryMin = null,
        ?int $salaryMax = null,
    ): array {
        $input = [
            'location' => $location,
            'maxResults' => $maxResults,
        ];

        if ($language !== Language::Auto) {
            $input['language'] = $language->value;
        }

        if ($country !== Country::Auto) {
            $input['country'] = $country->value;
        }

        if ($categoryId !== '') {
            $input['categoryId'] = $categoryId;
        }

        if ($salaryMin !== null) {
            $input['salaryMin'] = $salaryMin;
        }

        if ($salaryMax !== null) {
            $input['salaryMax'] = $salaryMax;
        }

        try {
            $items = $this->runActor($this->config->jobsActorId, $input);

            return array_map(
                static fn (array $item): Job => Job::fromArray($item),
                $items
            );
        } catch (GuzzleException $e) {
            $this->handleGuzzleException($e);
        }
    }

    /**
     * Run an Apify actor and return the dataset items.
     *
     * @param  array<string, mixed>  $input
     * @return array<int, array<string, mixed>>
     *
     * @throws ApiException
     * @throws GuzzleException
     */
    private function runActor(string $actorId, array $input): array
    {
        $response = $this->http->post("/acts/{$actorId}/runs", [
            'json' => $input,
            'query' => ['waitForFinish' => $this->config->timeout],
        ]);

        /** @var array<string, mixed> $result */
        $result = json_decode($response->getBody()->getContents(), true);

        if (! isset($result['data']['defaultDatasetId'])) {
            throw new ApiException('Invalid API response: missing dataset ID');
        }

        /** @var string $datasetId */
        $datasetId = $result['data']['defaultDatasetId'];

        return $this->fetchDataset($datasetId);
    }

    /**
     * Fetch items from an Apify dataset.
     *
     * @return array<int, array<string, mixed>>
     *
     * @throws ApiException
     */
    private function fetchDataset(string $datasetId): array
    {
        try {
            $response = $this->http->get("/datasets/{$datasetId}/items");

            /** @var array<int, array<string, mixed>> $items */
            $items = json_decode($response->getBody()->getContents(), true);

            return $items;
        } catch (GuzzleException $e) {
            throw new ApiException('Failed to fetch dataset: '.$e->getMessage(), 0, $e);
        }
    }

    /**
     * @throws ApiException
     * @throws RateLimitException
     */
    private function handleGuzzleException(GuzzleException $e): never
    {
        $response = method_exists($e, 'getResponse') ? $e->getResponse() : null;

        if ($response !== null) {
            $statusCode = $response->getStatusCode();

            if ($statusCode === 429) {
                $retryAfter = (int) ($response->getHeader('Retry-After')[0] ?? 60);
                throw new RateLimitException('Rate limit exceeded', $retryAfter);
            }
        }

        throw new ApiException('API request failed: '.$e->getMessage(), 0, $e);
    }
}
