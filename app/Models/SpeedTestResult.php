<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpeedTestResult extends Model
{
    protected $fillable = [
        'ping_ms',
        'download_mbps',
        'upload_mbps',
        'test_mode',
        'server_name',
        'ip_hash',
        'user_agent',
    ];

    protected $casts = [
        'ping_ms' => 'float',
        'download_mbps' => 'float',
        'upload_mbps' => 'float',
    ];
}
