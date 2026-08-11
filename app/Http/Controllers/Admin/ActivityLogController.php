<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function __construct(
        protected ActivityLogService $activityLogService,
    ) {}

    /**
     * Display the activity log feed.
     */
    public function index(Request $request)
    {
        $type = $request->query('type');
        $logs = $this->activityLogService->getPaginated($type);

        return view('admin.activity', compact('logs', 'type'));
    }
}
