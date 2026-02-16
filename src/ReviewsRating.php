<?php

declare(strict_types=1);

namespace TwoGisParser;

enum ReviewsRating: string
{
    case All = 'all';
    case Positive = 'positive';
    case Negative = 'negative';
}
