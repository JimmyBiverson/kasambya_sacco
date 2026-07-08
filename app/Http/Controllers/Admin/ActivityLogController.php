<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(): View
    {
        $logs = AuditLog::with('user')
            ->orderByDesc('id')
            ->paginate(30);

        return view('admin.activity-log.index', compact('logs'));
    }
}
