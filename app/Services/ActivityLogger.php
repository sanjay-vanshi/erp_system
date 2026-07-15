<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogger
{
    public static function log(
        string $action,
        string $module,
        ?int $recordId = null,
        ?string $description = null
    ) {

        ActivityLog::create([

            'user_id' => auth()->id(),

            'action' => $action,

            'module' => $module,

            'record_id' => $recordId,

            'description' => $description,

        ]);

    }
}
