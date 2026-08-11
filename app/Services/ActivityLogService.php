<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogService
{
    /**
     * Create a new activity log entry.
     */
    public function log(
        string $type,
        string $title,
        string $message,
        ?string $actionUrl = null,
        ?array $metadata = null
    ): ActivityLog {
        return ActivityLog::log($type, $title, $message, $actionUrl, $metadata);
    }

    /**
     * Get recent activity logs, optionally filtered by type.
     */
    public function getRecent(?string $type = null, int $limit = 20)
    {
        $query = ActivityLog::latestFirst();

        if ($type) {
            $query->ofType($type);
        }

        return $query->limit($limit)->get();
    }

    /**
     * Get paginated activity logs.
     */
    public function getPaginated(?string $type = null, int $perPage = 30)
    {
        $query = ActivityLog::latestFirst();

        if ($type) {
            $query->ofType($type);
        }

        return $query->paginate($perPage);
    }
}
