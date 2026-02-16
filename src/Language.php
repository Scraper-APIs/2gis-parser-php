<?php

declare(strict_types=1);

namespace TwoGisParser;

enum Language: string
{
    case Auto = 'auto';
    case Russian = 'ru';
    case English = 'en';
    case Arabic = 'ar';
    case Kazakh = 'kk';
    case Uzbek = 'uz';
    case Kyrgyz = 'ky';
    case Armenian = 'hy';
    case Georgian = 'ka';
    case Azerbaijani = 'az';
    case Tajik = 'tg';
    case Czech = 'cs';
    case Spanish = 'es';
    case Italian = 'it';
}
