<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(): View
    {
        $logs = LoginHistory::with('user')
            ->orderByDesc('created_at')
            ->paginate(30);

        return view('admin.activity-log.index', compact('logs'));
    }
}
