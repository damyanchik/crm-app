<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderStatusEnum;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getDashboardData(): object
    {
        $endDate = Carbon::now();
        $startDateLastWeek = $endDate->copy()->subWeeks(2);
        $endDateLastWeek = $endDate->copy()->subWeeks(1);

        return $this->prepareDashboardQuery($endDate, $startDateLastWeek, $endDateLastWeek)->first();
    }

    private function prepareDashboardQueryLastYear($startDateLastYear, $endDate)
    {
        return DB::table('orders')
            ->whereBetween('updated_at', [$startDateLastYear, $endDate])
            ->where('status','=', OrderStatusEnum::CLOSED['id'])
            ->get();
    }

    private function prepareDashboardQuery(object $endDate, object $startDateLastWeek, object $endDateLastWeek): object
    {
        return DB::table('orders')
            ->select(
                DB::raw('SUM(CASE WHEN updated_at BETWEEN ? AND ? THEN total_price ELSE 0 END) as totalSalesLastWeek'),
                DB::raw('SUM(CASE WHEN updated_at BETWEEN ? AND ? THEN total_quantity ELSE 0 END) as totalProductsSoldLastWeek'),
                DB::raw('COUNT(DISTINCT CASE WHEN updated_at BETWEEN ? AND ? THEN client_id ELSE NULL END) as customersLastWeek'),
                DB::raw('COUNT(DISTINCT CASE WHEN updated_at BETWEEN ? AND ? THEN id ELSE NULL END) as totalOrdersLastWeek'),
                DB::raw('SUM(CASE WHEN updated_at BETWEEN ? AND ? THEN total_price ELSE 0 END) as totalSalesThisWeek'),
                DB::raw('SUM(CASE WHEN updated_at BETWEEN ? AND ? THEN total_quantity ELSE 0 END) as totalProductsSoldThisWeek'),
                DB::raw('COUNT(DISTINCT CASE WHEN updated_at BETWEEN ? AND ? THEN client_id ELSE NULL END) as customersThisWeek'),
                DB::raw('COUNT(DISTINCT CASE WHEN updated_at BETWEEN ? AND ? THEN id ELSE NULL END) as totalOrdersThisWeek')
            )
            ->setBindings([
                $startDateLastWeek,
                $endDateLastWeek,
                $startDateLastWeek,
                $endDateLastWeek,
                $startDateLastWeek,
                $endDateLastWeek,
                $startDateLastWeek,
                $endDateLastWeek,
                $endDateLastWeek,
                $endDate,
                $endDateLastWeek,
                $endDate,
                $endDateLastWeek,
                $endDate,
                $endDateLastWeek,
                $endDate
            ])
            ->where('status','=', OrderStatusEnum::CLOSED['id']);
    }
}
