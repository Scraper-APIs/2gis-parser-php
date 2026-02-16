<?php

declare(strict_types=1);

namespace TwoGisParser;

enum PropertyCategory: string
{
    case SaleResidential = 'sale_residential';
    case SaleCommercial = 'sale_commercial';
    case RentResidential = 'rent_residential';
    case RentCommercial = 'rent_commercial';
    case DailyRent = 'daily_rent';
}
