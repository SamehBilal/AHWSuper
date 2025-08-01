<?php

namespace Modules\AHWStore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\AHWStore\Database\Factories\APITokenFactory;

class APIToken extends Model
{
    use HasFactory;
    protected $table = 'store.api_tokens';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'provider',
        'provider_id',
        'access_token',
        'refresh_token',
        'client_id',
        'client_secret',
        'organization_id',
        'redirect_url',
        'base_url'
    ];

    // protected static function newFactory(): APITokenFactory
    // {
    //     // return APITokenFactory::new();
    // }
}
