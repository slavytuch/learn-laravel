<?php

namespace App\Services;

use App\Enum\CatalogFilterOperation;
use App\Interfaces\CatalogFilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CatalogFilterService implements CatalogFilterInterface
{
    const STATEMENT_DELIMITER = '-and-';
    const RELATION = 'properties';
    const OPERATION_VALUE_DELIMITER = '-or-';
    const UNARY_OPERATIONS = [
        CatalogFilterOperation::MoreThan,
        CatalogFilterOperation::LessThan,
    ];
    const BINARY_OPERATIONS = [
        CatalogFilterOperation::Between,
    ];

    const MULTIPLE_OPERATIONS = [
        CatalogFilterOperation::Equal,
        CatalogFilterOperation::NotEqual,
        CatalogFilterOperation::Contains,
    ];

    const NUMERIC_OPERATIONS = [
        CatalogFilterOperation::Between,
        CatalogFilterOperation::MoreThan,
        CatalogFilterOperation::LessThan
    ];

    protected $filterParts = [];

    /**
     * Filter examples:
     * multiple: <statement>-and-<statement>
     * <property>-is-<value>
     * <property>-not-<value>
     * <property>-is-<value>-or-<value>-....
     * <property>-not-<value>-or-<value>-....
     * <property>-like-<value>
     * <property>-like-<value>-or-<value>-...
     * <property>-between-<value>-<value>
     * <property>-more-than-<value>
     * <property>-less-than-<value>
     */
    public function processFilter(string $filter, Builder $query): Collection
    {
        if (!$filter) {
            return $query->get();
        }

        $statementList = explode(static::STATEMENT_DELIMITER, $filter);


        $filterListIs = [];
        $filterListIsNot = [];
        $filterListBetween = [];
        $filterListLike = [];
        $filterListMoreThan = [];
        $filterListLessThan = [];
        foreach ($statementList as $statement) {
            if (str_contains($statement, '-is-')) {
                list($propertyCode, $value) = explode('-is-', $statement);
                $filterListIs[$propertyCode] = explode(
                    static::OPERATION_VALUE_DELIMITER,
                    $value
                );
                continue;
            }
            if (str_contains($statement, '-not-')) {
                list($propertyCode, $value) = explode('-not-', $statement);
                $filterListIsNot[$propertyCode] = explode(
                    static::OPERATION_VALUE_DELIMITER,
                    $value
                );
                continue;
            }
            if (str_contains($statement, '-between-')) {
                list($propertyCode, $values) = explode('-between-', $statement);
                $filterListBetween[$propertyCode] = array_map(
                    'intval',
                    explode('-', $values)
                );
                continue;
            }
            if (str_contains($statement, '-like-')) {
                list($propertyCode, $value) = explode('-like-', $statement);
                $filterListLike[$propertyCode] = explode(
                    static::OPERATION_VALUE_DELIMITER,
                    $value
                );
                continue;
            }
            if (str_contains($statement, '-more-than-')) {
                list($propertyCode, $value) = explode(
                    '-more-than-',
                    $statement
                );
                $filterListMoreThan[$propertyCode] = $value;
                continue;
            }
            if (str_contains($statement, '-less-than-')) {
                list($propertyCode, $value) = explode(
                    '-less-than-',
                    $statement
                );
                $filterListLessThan[$propertyCode] = $value;
                continue;
            }
        }

        foreach ($filterListIs as $filterCode => $filterValue) {
            $query = $query->whereHas(
                static::RELATION,
                function ($property) use ($filterCode, $filterValue) {
                    $firstValue = array_pop($filterValue);
                    $property = $property->where([
                        ['code', '=', $filterCode],
                        ['value', '=', $firstValue]
                    ]);
                    foreach ($filterValue as $otherValue) {
                        $property->orWhere([
                            ['code', '=', $filterCode],
                            ['value', '=', $otherValue]
                        ]);
                    }
                }
            );
        }

        foreach ($filterListIsNot as $filterCode => $filterValue) {
            $query = $query->whereHas(
                static::RELATION,
                function ($property) use ($filterCode, $filterValue) {
                    $firstValue = array_pop($filterValue);
                    $property = $property->whereNot([
                        ['code', '=', $filterCode],
                        ['value', '=', $firstValue]
                    ]);
                    foreach ($filterValue as $otherValue) {
                        $property->orWhereNot([
                            ['code', '=', $filterCode],
                            ['value', '=', $otherValue]
                        ]);
                    }
                }
            );
        }

        foreach ($filterListBetween as $filterCode => $filterValue) {
            $query = $query->whereHas(
                static::RELATION,
                function ($property) use ($filterCode, $filterValue) {
                    $property->where([
                        ['code', '=', $filterCode],
                        ['value', '>=', $filterValue[0]],
                        ['value', '<=', $filterValue[1]]
                    ]);
                }
            );
        }
        foreach ($filterListLike as $filterCode => $filterValue) {
            $query = $query->whereHas(
                static::RELATION,
                function ($property) use ($filterCode, $filterValue) {
                    $firstValue = array_pop($filterValue);
                    $property = $property->where([
                        ['code', '=', $filterCode],
                        ['value', 'like', '%'.$firstValue.'%']
                    ]);
                    foreach ($filterValue as $otherValue) {
                        $property->orWhere([
                            ['code', '=', $filterCode],
                            ['value', 'like', '%'.$otherValue.'%']
                        ]);
                    }
                }
            );
        }
        foreach ($filterListLessThan as $filterCode => $filterValue) {
            $query = $query->whereHas(
                static::RELATION,
                function ($property) use ($filterCode, $filterValue) {
                    $property->where([
                        ['code', '=', $filterCode],
                        ['value', '<=', $filterValue]
                    ]);
                }
            );
        }

        foreach ($filterListMoreThan as $filterCode => $filterValue) {
            $query = $query->whereHas(
                static::RELATION,
                function ($property) use ($filterCode, $filterValue) {
                    $property->where([
                        ['code', '=', $filterCode],
                        ['value', '>=', $filterValue]
                    ]);
                }
            );
        }

        return $query->get();
    }

    public function getProductsByFilter(
        string $filter,
        Builder $query
    ): Collection {
        if (!$filter) {
            return $query->get();
        }
        $statementList = explode(static::STATEMENT_DELIMITER, $filter);

        foreach ($statementList as $statement) {
            foreach (CatalogFilterOperation::cases() as $operation) {
                if (str_contains($statement, $operation->value)) {
                    $this->filterParts[$operation->name] = $this->processOperation(
                        $operation,
                        $statement
                    );
                    break;
                }
            }
        }

        foreach ($this->filterParts as $operationName => $filterPart) {
            foreach ($filterPart as $filterCode => $filterValue) {
                $query = $query->whereHas(
                    static::RELATION,
                    function ($property) use ($filterCode, $filterValue, $operationName) {
                    }
                );
            }
        }

        return $query->get();
    }

    protected function processOperation(
        CatalogFilterOperation $operation,
        $statement
    ) {
        $result = [];
        list($propertyCode, $value) = explode($operation->value, $statement);
        $result[$propertyCode] = $this->operationIsUnary(
            $operation
        ) ? $value : ($this->operationIsBinary($operation) ?
            explode('-', $value) :
            ($this->operationIsMultiple($operation) ?
                explode(static::OPERATION_VALUE_DELIMITER, $value) : ''
            )
        );

        return $result;
    }

    protected function operationIsUnary(CatalogFilterOperation $operation): bool
    {
        return in_array($operation, static::UNARY_OPERATIONS);
    }

    protected function operationIsBinary(CatalogFilterOperation $operation
    ): bool {
        return in_array($operation, static::BINARY_OPERATIONS);
    }

    protected function operationIsMultiple(CatalogFilterOperation $operation
    ): bool {
        return in_array($operation, static::MULTIPLE_OPERATIONS);
    }

}
