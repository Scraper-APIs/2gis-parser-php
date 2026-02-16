<?php

declare(strict_types=1);

use TwoGisParser\Country;
use TwoGisParser\Language;
use TwoGisParser\PropertyCategory;
use TwoGisParser\PropertySort;
use TwoGisParser\RatingFilter;
use TwoGisParser\ReviewsRating;
use TwoGisParser\ReviewsSource;

it('has correct language values', function () {
    expect(Language::Auto->value)->toBe('auto')
        ->and(Language::Russian->value)->toBe('ru')
        ->and(Language::English->value)->toBe('en')
        ->and(Language::Arabic->value)->toBe('ar')
        ->and(Language::Kazakh->value)->toBe('kk')
        ->and(Language::Uzbek->value)->toBe('uz')
        ->and(Language::Kyrgyz->value)->toBe('ky')
        ->and(Language::Armenian->value)->toBe('hy')
        ->and(Language::Georgian->value)->toBe('ka')
        ->and(Language::Azerbaijani->value)->toBe('az')
        ->and(Language::Tajik->value)->toBe('tg')
        ->and(Language::Czech->value)->toBe('cs')
        ->and(Language::Spanish->value)->toBe('es')
        ->and(Language::Italian->value)->toBe('it');
});

it('can create language from value', function () {
    expect(Language::from('auto'))->toBe(Language::Auto)
        ->and(Language::from('ru'))->toBe(Language::Russian)
        ->and(Language::from('en'))->toBe(Language::English)
        ->and(Language::from('ar'))->toBe(Language::Arabic);
});

it('has correct country values', function () {
    expect(Country::Auto->value)->toBe('')
        ->and(Country::Russia->value)->toBe('ru')
        ->and(Country::Kazakhstan->value)->toBe('kz')
        ->and(Country::UAE->value)->toBe('ae')
        ->and(Country::Uzbekistan->value)->toBe('uz')
        ->and(Country::Kyrgyzstan->value)->toBe('kg')
        ->and(Country::Armenia->value)->toBe('am')
        ->and(Country::Georgia->value)->toBe('ge')
        ->and(Country::Azerbaijan->value)->toBe('az')
        ->and(Country::Belarus->value)->toBe('by')
        ->and(Country::Tajikistan->value)->toBe('tj')
        ->and(Country::SaudiArabia->value)->toBe('sa')
        ->and(Country::Bahrain->value)->toBe('bh')
        ->and(Country::Kuwait->value)->toBe('kw')
        ->and(Country::Qatar->value)->toBe('qa')
        ->and(Country::Oman->value)->toBe('om')
        ->and(Country::Iraq->value)->toBe('iq')
        ->and(Country::Chile->value)->toBe('cl')
        ->and(Country::Czechia->value)->toBe('cz')
        ->and(Country::Italy->value)->toBe('it')
        ->and(Country::Cyprus->value)->toBe('cy');
});

it('can create country from value', function () {
    expect(Country::from(''))->toBe(Country::Auto)
        ->and(Country::from('ru'))->toBe(Country::Russia)
        ->and(Country::from('kz'))->toBe(Country::Kazakhstan)
        ->and(Country::from('ae'))->toBe(Country::UAE);
});

it('has correct rating filter values', function () {
    expect(RatingFilter::None->value)->toBe('')
        ->and(RatingFilter::Perfect->value)->toBe('perfect')
        ->and(RatingFilter::Excellent->value)->toBe('excellent')
        ->and(RatingFilter::PrettyGood->value)->toBe('pretty_good')
        ->and(RatingFilter::Nice->value)->toBe('nice')
        ->and(RatingFilter::NotBad->value)->toBe('not_bad');
});

it('can create rating filter from value', function () {
    expect(RatingFilter::from(''))->toBe(RatingFilter::None)
        ->and(RatingFilter::from('perfect'))->toBe(RatingFilter::Perfect)
        ->and(RatingFilter::from('excellent'))->toBe(RatingFilter::Excellent)
        ->and(RatingFilter::from('pretty_good'))->toBe(RatingFilter::PrettyGood)
        ->and(RatingFilter::from('nice'))->toBe(RatingFilter::Nice)
        ->and(RatingFilter::from('not_bad'))->toBe(RatingFilter::NotBad);
});

it('has correct reviews rating values', function () {
    expect(ReviewsRating::All->value)->toBe('all')
        ->and(ReviewsRating::Positive->value)->toBe('positive')
        ->and(ReviewsRating::Negative->value)->toBe('negative');
});

it('can create reviews rating from value', function () {
    expect(ReviewsRating::from('all'))->toBe(ReviewsRating::All)
        ->and(ReviewsRating::from('positive'))->toBe(ReviewsRating::Positive)
        ->and(ReviewsRating::from('negative'))->toBe(ReviewsRating::Negative);
});

it('has correct reviews source values', function () {
    expect(ReviewsSource::All->value)->toBe('all')
        ->and(ReviewsSource::TwoGis->value)->toBe('2gis')
        ->and(ReviewsSource::Flamp->value)->toBe('flamp')
        ->and(ReviewsSource::Booking->value)->toBe('booking');
});

it('can create reviews source from value', function () {
    expect(ReviewsSource::from('all'))->toBe(ReviewsSource::All)
        ->and(ReviewsSource::from('2gis'))->toBe(ReviewsSource::TwoGis)
        ->and(ReviewsSource::from('flamp'))->toBe(ReviewsSource::Flamp)
        ->and(ReviewsSource::from('booking'))->toBe(ReviewsSource::Booking);
});

it('has correct property category values', function () {
    expect(PropertyCategory::SaleResidential->value)->toBe('sale_residential')
        ->and(PropertyCategory::SaleCommercial->value)->toBe('sale_commercial')
        ->and(PropertyCategory::RentResidential->value)->toBe('rent_residential')
        ->and(PropertyCategory::RentCommercial->value)->toBe('rent_commercial')
        ->and(PropertyCategory::DailyRent->value)->toBe('daily_rent');
});

it('can create property category from value', function () {
    expect(PropertyCategory::from('sale_residential'))->toBe(PropertyCategory::SaleResidential)
        ->and(PropertyCategory::from('sale_commercial'))->toBe(PropertyCategory::SaleCommercial)
        ->and(PropertyCategory::from('rent_residential'))->toBe(PropertyCategory::RentResidential)
        ->and(PropertyCategory::from('rent_commercial'))->toBe(PropertyCategory::RentCommercial)
        ->and(PropertyCategory::from('daily_rent'))->toBe(PropertyCategory::DailyRent);
});

it('has correct property sort values', function () {
    expect(PropertySort::Default->value)->toBe('')
        ->and(PropertySort::PriceAsc->value)->toBe('price_asc')
        ->and(PropertySort::PriceDesc->value)->toBe('price_desc')
        ->and(PropertySort::AreaAsc->value)->toBe('area_asc')
        ->and(PropertySort::AreaDesc->value)->toBe('area_desc');
});

it('can create property sort from value', function () {
    expect(PropertySort::from(''))->toBe(PropertySort::Default)
        ->and(PropertySort::from('price_asc'))->toBe(PropertySort::PriceAsc)
        ->and(PropertySort::from('price_desc'))->toBe(PropertySort::PriceDesc)
        ->and(PropertySort::from('area_asc'))->toBe(PropertySort::AreaAsc)
        ->and(PropertySort::from('area_desc'))->toBe(PropertySort::AreaDesc);
});
