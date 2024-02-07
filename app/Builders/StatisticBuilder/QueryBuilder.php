<?php

declare(strict_types=1);

namespace App\Builders\StatisticBuilder;

use Illuminate\Support\Facades\DB;

abstract class QueryBuilder
{
    protected string $dateColumn;
    protected object $query;

    public function setTable(string $table): object
    {
        $this->query = DB::table($table);

        return $this;
    }

    public function setDataColumn(string $dateColumn): void
    {
        $this->dateColumn = $dateColumn;
    }

    public function getQuery(): object
    {
        return $this->query;
    }
}
