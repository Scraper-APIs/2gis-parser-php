<?php

declare(strict_types=1);

namespace TwoGisParser;

enum PropertySort: string
{
    case Default = '';
    case PriceAsc = 'price_asc';
    case PriceDesc = 'price_desc';
    case AreaAsc = 'area_asc';
    case AreaDesc = 'area_desc';
}
