<?php

declare(strict_types=1);

namespace TwoGisParser;

enum RatingFilter: string
{
    case None = '';
    case Perfect = 'perfect';
    case Excellent = 'excellent';
    case PrettyGood = 'pretty_good';
    case Nice = 'nice';
    case NotBad = 'not_bad';
}
