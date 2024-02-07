<?php

declare(strict_types=1);

namespace App\Services;

use App\Builders\StatisticBuilder\StatisticBuilder;
use App\Enum\OrderStatusEnum;
use Illuminate\Support\Carbon;

class DashboardService
{
    public function __construct(protected StatisticBuilder $statisticBuilder)
    {
    }

    public function getDashboardData(): array
    {
        $endDate = Carbon::now();
        $startDateLastWeek = $endDate->copy()->subWeeks(2);
        $endDateLastWeek = $endDate->copy()->subWeeks(1);
        $startYear = $endDate->copy()->subYear(1);

        $lastWeek = [$startDateLastWeek, $endDateLastWeek];
        $thisWeek = [$endDateLastWeek, $endDate];
        $lastYear = [$startYear, $endDate];

        $this->statisticBuilder->setTable('orders');
        $this->statisticBuilder->setDataColumn('updated_at');

        $this->buildBasicStatistics($this->statisticBuilder, $lastYear, $lastWeek, $thisWeek);
        $this->getEveryMonth($endDate, $this->statisticBuilder, 'TotalSalesMonth');
        $this->statisticBuilder->where('status', [OrderStatusEnum::CLOSED['id']]);

        return $this->orderFromLastMonth($this->statisticBuilder->getQuery()->first());
    }

    private function buildBasicStatistics(object $builder, array $lastYear, array $lastWeek, array $thisWeek): void
    {
        $builder
            ->selectSum('total_price', 'totalSalesLastYear', $lastYear)
            ->selectSum('total_price', 'totalSalesLastWeek', $lastWeek)
            ->selectSum('total_quantity', 'totalProductsSoldLastWeek', $lastWeek)
            ->selectCount('client_id', 'customersLastWeek', $lastWeek)
            ->selectCount('id', 'totalOrdersLastWeek', $lastWeek)
            ->selectSum('total_price', 'totalSalesThisWeek', $thisWeek)
            ->selectSum('total_quantity', 'totalProductsSoldThisWeek', $thisWeek)
            ->selectCount('client_id', 'customersThisWeek', $thisWeek)
            ->selectCount('id', 'totalOrdersThisWeek', $thisWeek);
    }

    private function getEveryMonth(object $endDate, object $builder, string $prefix): void
    {
        for ($i = 0; $i < 12; $i++) {
            $startMonth = $endDate->copy()->subMonths($i)->startOfMonth();
            $endMonth = $endDate->copy()->subMonths($i)->endOfMonth();
            $monthRange = [$startMonth, $endMonth];
            $builder->selectSum('total_price', $prefix.$i, $monthRange);
        }
    }

    private function orderFromLastMonth(object $data): array
    {
        $filteredSales = [];
        $i = 0;

        $filteredData = [];
        foreach ($data as $key => $value) {
            if (str_starts_with($key, 'TotalSalesMonth')) {
                $filteredSales[$this->orderMonthsFromToday()[$i]] = $value;
                $i++;
                continue;
            }
            $filteredData[$key] = $value;
        }

        return $filteredData += ['months' => $filteredSales];
    }

    private function orderMonthsFromToday(): array
    {
        $months = range(1, 12);

        $currentMonth = now()->month;

        $currentMonthIndex = array_search($currentMonth, $months);

        return array_merge(
            array_slice($months, $currentMonthIndex),
            array_slice($months, 0, $currentMonthIndex)
        );
    }
}
