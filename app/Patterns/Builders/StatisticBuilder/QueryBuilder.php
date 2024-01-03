<?php

declare(strict_types=1);

namespace App\Patterns\Builders\StatisticBuilder;

use Illuminate\Support\Facades\DB;

abstract class QueryBuilder
{
    protected string $dateColumn;
    protected object $query;

    /**
     * Select a table from Database.
     */
    public function setTable(string $table): object
    {
        $this->query = DB::table($table);

        return $this;
    }

    /**
     * Select the column with the date that will be taken into account.
     */
    public function setDataColumn(string $dateColumn): void
    {
        $this->dateColumn = $dateColumn;
    }

    /**
     * The last step, get ready query.
     */
    public function getQuery(): object
    {
        return $this->query;
    }
}
