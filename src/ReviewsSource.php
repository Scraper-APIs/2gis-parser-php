<?php

declare(strict_types=1);

namespace TwoGisParser;

enum ReviewsSource: string
{
    case All = 'all';
    case TwoGis = '2gis';
    case Flamp = 'flamp';
    case Booking = 'booking';
}
