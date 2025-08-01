<?php

namespace Modules\Developers\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppAnalytic extends Model
{
    use HasFactory;

    protected $table = 'developers.app_analytics';

    public $timestamps = false; // Using only created_at

    protected $fillable = [
        'app_id',
        'user_id',
        'endpoint',
        'method',
        'status_code',
        'response_time_ms',
        'ip_address',
        'user_agent',
        'request_data'
    ];

    protected $casts = [
        'request_data' => 'array',
        'created_at' => 'datetime'
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
