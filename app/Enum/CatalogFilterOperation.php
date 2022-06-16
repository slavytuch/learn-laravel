<?php

namespace App\Enum;

enum CatalogFilterOperation: string
{
    case Equal = '-is-';
    case NotEqual = '-not-';
    case Contains = '-like-';
    case Between = '-between';
    case MoreThan = '-more-than-';
    case LessThan = '-less-than';
}
