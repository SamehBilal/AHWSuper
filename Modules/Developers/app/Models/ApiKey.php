<?php

namespace Modules\Developers\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiKey extends Model
{
    use HasFactory;

    protected $table = 'developers.api_keys';

    protected $fillable = [
        'app_id',
        'name',
        'key',
        'is_active',
        'last_used_at',
        'rate_limit',
        'allowed_ips',
        'allowed_scopes'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_used_at' => 'datetime',
        'allowed_ips' => 'array',
        'allowed_scopes' => 'array'
    ];

    protected $hidden = [
        'key'
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($apiKey) {
            $apiKey->key = 'ah_' . \Illuminate\Support\Str::random(32);
        });
    }

    public function getMaskedKey(): string
    {
        return substr($this->key, 0, 8) . str_repeat('*', 20) . substr($this->key, -4);
    }
}
