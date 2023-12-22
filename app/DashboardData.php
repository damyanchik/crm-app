<?php

declare(strict_types=1);

namespace App;

use App\Enum\OrderStatusEnum;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardData
{
    public function getDashboardData(): object
    {
        $data = new DashboardData();
        return $data->getDashboardData();
    }

}
