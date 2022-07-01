<?php

namespace App\Interfaces\Catalog;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

interface FilterInterface
{
    /**
     * Обрабатывает входящую строку запроса как фильтр
     *
     * @param string $filter
     * @param Builder $query
     * @return Collection
    */
    public function processFilter(string $filter, Builder $query): Collection;
}
