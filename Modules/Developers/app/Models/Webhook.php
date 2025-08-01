<?php

namespace Modules\Developers\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Webhook extends Model
{
    use HasFactory;

    protected $table = 'developers.webhooks';

    protected $fillable = [
        'app_id',
        'name',
        'url',
        'events',
        'secret',
        'is_active',
        'max_retries',
        'last_triggered_at'
    ];

    protected $casts = [
        'events' => 'array',
        'is_active' => 'boolean',
        'last_triggered_at' => 'datetime'
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($webhook) {
            if (!$webhook->secret) {
                $webhook->secret = \Illuminate\Support\Str::random(32);
            }
        });
    }
}
