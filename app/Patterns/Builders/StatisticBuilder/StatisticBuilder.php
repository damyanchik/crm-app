<?php

declare(strict_types=1);

namespace App\Patterns\Builders\StatisticBuilder;

use Illuminate\Support\Facades\DB;

class StatisticBuilder extends QueryBuilder implements StatisticBuilderInterface
{
    /**
     * Summarize the column in the specified period and give it an alias.
     */
    public function selectSum(string $column, string $alias, array $dateRange): object
    {
        $this->query->addSelect(
            DB::raw(
                "SUM(CASE WHEN $this->dateColumn BETWEEN ? AND ? THEN $column ELSE 0 END) as $alias"
            )
        );

        $this->query->addBinding($dateRange[0]);
        $this->query->addBinding($dateRange[1]);

        return $this;
    }

    /**
     * Count the columns in a specific period and give them an alias.
     */
    public function selectCount(string $column, string $alias, array $dateRange): object
    {
        $this->query->addSelect(
            DB::raw(
                "COUNT(DISTINCT CASE WHEN $this->dateColumn BETWEEN ? AND ? THEN $column ELSE NULL END) as $alias"
            )
        );

        $this->query->addBinding($dateRange[0]);
        $this->query->addBinding($dateRange[1]);

        return $this;
    }

    /**
     * Set condition for records.
     */
    public function where(string $column, array $values): object
    {
        $this->query->whereIn($column, $values);

        return $this;
    }
}
