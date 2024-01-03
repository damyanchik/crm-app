<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Models\Order;
use App\Services\ArchiveService;
use Illuminate\View\View;

class ArchiveController extends Controller
{
    public function __construct(protected ArchiveService $archiveService)
    {
    }

    public function index(IndexRequest $request): View
    {
        return view('orders.index', [
            'orders' => $this->archiveService->getAll($request)
        ]);
    }

    public function show(Order $order): View
    {
        return view('orders.show', [
            'order' => $order,
        ]);
    }
}
