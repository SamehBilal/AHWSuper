<?php

namespace Modules\Developers\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class App extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
        'slug',
        'description',
        'website_url',
        'callback_url',
        'redirect_uris',
        'logo_url',
        'screenshots',
        'status',
        'type',
        'scopes',
        'is_public',
        'developer_id',
        'oauth_client_id'
    ];

    protected $casts = [
        'redirect_uris' => 'array',
        'screenshots' => 'array',
        'scopes' => 'array',
        'is_public' => 'boolean'
    ];

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function oauthClient()
    {
        return $this->belongsTo(Client::class, 'oauth_client_id');
    }

    public function apiKeys()
    {
        return $this->hasMany(ApiKey::class);
    }

    public function analytics()
    {
        return $this->hasMany(AppAnalytic::class);
    }

    // Create OAuth client when app is approved
    public function createOAuthClient()
    {
        if ($this->status === 'approved' && !$this->oauth_client_id) {
            $client = Client::create([
                'name'                      => $this->name,
                'secret'                    => \Illuminate\Support\Str::random(40),
                'redirect'                  => implode(',', $this->redirect_uris),
                'personal_access_client'    => false,
                'password_client'           => false,
                'revoked'                   => false,
            ]);

            $this->update(['oauth_client_id' => $client->id]);
            return $client;
        }
        
        return $this->oauthClient;
    }

    public function getClientId(): ?string
    {
        return $this->oauthClient?->id;
    }

    public function getClientSecret(): ?string
    {
        return $this->oauthClient?->secret;
    }
}