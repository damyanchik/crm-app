<?php

declare(strict_types=1);

namespace App\Builders\StatisticBuilder;

interface StatisticBuilderInterface
{
    public function selectSum(string $column, string $alias, array $dateRange);

    public function selectCount(string $column, string $alias, array $dateRange);

    public function where(string $column, array $values);

    public function getQuery();
}
