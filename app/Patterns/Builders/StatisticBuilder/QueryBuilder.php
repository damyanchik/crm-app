<?php

declare(strict_types=1);

namespace App\Patterns\Builders\StatisticBuilder;

use Illuminate\Support\Facades\DB;

abstract class QueryBuilder
{
    protected string $dateColumn;
    protected object $query;

    public function __construct(string $table, string $dateColumn = 'created_at')
    {
        $this->from($table);
        $this->dateColumn($dateColumn);
    }

    protected function dateColumn(string $dateColumn): void
    {
        $this->dateColumn = $dateColumn;
    }

    protected function from(string $table): object
    {
        $this->query = DB::table($table);

        return $this;
    }

    public function getQuery(): object
    {
        return $this->query;
    }
}
