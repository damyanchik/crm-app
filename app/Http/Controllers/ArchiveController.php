<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\ArchiveService;

class ArchiveController extends Controller
{
    public function __construct(protected ArchiveService $archiveService)
    {
    }

    public function index(): object
    {
        return view('orders.index', [
            'orders' => $this->archiveService->getArchives()
        ]);
    }

    public function show(Order $order): object
    {
        return view('orders.show', [
            'order' => $order,
        ]);
    }
}
