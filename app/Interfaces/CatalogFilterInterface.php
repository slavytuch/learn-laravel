<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface CatalogFilterInterface
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
