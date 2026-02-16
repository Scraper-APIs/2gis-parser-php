# 2GIS Parser PHP

PHP-библиотека для парсинга данных 2ГИС: организации, отзывы, недвижимость, вакансии.

Работает через [Apify API](https://apify.com/) — запускает акторы и возвращает типизированные DTO.

## Установка

```bash
composer require scraper-apis/2gis-parser
```

## Быстрый старт

```php
use TwoGisParser\Client;

$client = new Client('apify_api_ваш_токен');

// Поиск ресторанов в Москве
$places = $client->scrapePlaces(
    query: ['ресторан'],
    location: 'Москва',
    maxResults: 50,
);

foreach ($places as $place) {
    echo "{$place->name} — {$place->address}" . PHP_EOL;
    echo "Рейтинг: {$place->rating}, отзывов: {$place->reviewCount}" . PHP_EOL;

    if ($place->hasContactInfo()) {
        echo "Тел: {$place->getFirstPhone()}" . PHP_EOL;
    }
}
```

## Методы

### Организации

```php
$places = $client->scrapePlaces(
    query: ['стоматология', 'клиника'],
    location: 'Санкт-Петербург',
    maxResults: 200,
    language: Language::Russian,
    country: Country::Russia,
    options: [
        'filterRating' => 'excellent',      // 4.5+
        'skipClosedPlaces' => true,
        'maxReviews' => 10,                  // подгрузить отзывы
        'filterCardPayment' => true,
    ],
);
```

### Отзывы

```php
$reviews = $client->scrapeReviews(
    startUrls: ['https://2gis.ru/moscow/firm/70000001057394703'],
    maxReviews: 100,
    reviewsRating: ReviewsRating::Negative,  // только 1-2 звезды
    reviewsSource: ReviewsSource::TwoGis,
);

foreach ($reviews as $review) {
    echo "{$review->authorName}: {$review->rating}/5" . PHP_EOL;

    if ($review->hasOfficialAnswer()) {
        echo "Ответ: {$review->getOfficialAnswerText()}" . PHP_EOL;
    }
}
```

### Недвижимость

```php
$properties = $client->scrapeProperties(
    location: 'Казань',
    maxResults: 500,
    category: PropertyCategory::SaleResidential,
    sort: PropertySort::PriceAsc,
    options: [
        'rooms' => ['2', '3'],
        'priceMax' => 15000000,
        'notFirstFloor' => true,
    ],
);

foreach ($properties as $property) {
    echo "{$property->name} — {$property->getPriceFormatted()}" . PHP_EOL;
    echo "{$property->area} м², этаж {$property->floor}" . PHP_EOL;
}
```

### Вакансии

```php
$jobs = $client->scrapeJobs(
    location: 'Новосибирск',
    maxResults: 300,
    salaryMin: 80000,
);

foreach ($jobs as $job) {
    echo "{$job->name} — {$job->orgName}" . PHP_EOL;
    echo "Зарплата: {$job->salaryLabel}" . PHP_EOL;
}
```

## Фильтры и перечисления

| Enum | Значения |
|------|----------|
| `Language` | `Auto`, `Russian`, `English`, `Arabic`, `Kazakh`, `Uzbek`, `Kyrgyz`, `Armenian`, `Georgian`, `Azerbaijani`, `Tajik`, `Czech`, `Spanish`, `Italian` |
| `Country` | `Auto`, `Russia`, `Kazakhstan`, `UAE`, `Uzbekistan`, `Kyrgyzstan`, `Armenia`, `Georgia`, `Azerbaijan`, `Belarus`, `Tajikistan`, `SaudiArabia`, `Bahrain`, `Kuwait`, `Qatar`, `Oman`, `Iraq`, `Chile`, `Czechia`, `Italy`, `Cyprus` |
| `RatingFilter` | `None`, `Perfect` (4.9+), `Excellent` (4.5+), `PrettyGood` (4.0+), `Nice` (3.5+), `NotBad` (3.0+) |
| `ReviewsRating` | `All`, `Positive` (4-5), `Negative` (1-2) |
| `ReviewsSource` | `All`, `TwoGis`, `Flamp`, `Booking` |
| `PropertyCategory` | `SaleResidential`, `SaleCommercial`, `RentResidential`, `RentCommercial`, `DailyRent` |
| `PropertySort` | `Default`, `PriceAsc`, `PriceDesc`, `AreaAsc`, `AreaDesc` |

## Конфигурация

```php
use TwoGisParser\Client;
use TwoGisParser\Config;

$client = new Client('токен', new Config(
    apiToken: 'токен',
    placesActorId: 'zen-studio/2gis-places-scraper-api',   // по умолчанию
    reviewsActorId: 'zen-studio/2gis-reviews-scraper',
    propertyActorId: 'zen-studio/2gis-property-scraper',
    jobsActorId: 'zen-studio/2gis-jobs-scraper',
    timeout: 900,
));
```

## Обработка ошибок

```php
use TwoGisParser\Exception\ApiException;
use TwoGisParser\Exception\RateLimitException;

try {
    $places = $client->scrapePlaces(query: ['кафе'], location: 'Алматы');
} catch (RateLimitException $e) {
    sleep($e->retryAfter);
    // повторить запрос
} catch (ApiException $e) {
    echo "Ошибка API: {$e->getMessage()}" . PHP_EOL;
}
```

## Требования

- PHP 8.3+
- Токен [Apify API](https://console.apify.com/account/integrations)

## Лицензия

MIT
