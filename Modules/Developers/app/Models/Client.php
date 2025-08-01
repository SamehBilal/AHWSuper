<?php

namespace Modules\Developers\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Passport\Client as PassportClient;
use Modules\Developers\Models\AppTester;

class Client extends PassportClient
{
    /**
     * Determine if the client should skip the authorization prompt.
     *
     * @param  \Laravel\Passport\Scope[]  $scopes
     */
    public function skipsAuthorization(Authenticatable $user, array $scopes): bool
    {
        return $this->firstParty();
    }

    protected $table = 'developers.oauth_clients';

    // Add relationship to our App model
    public function developerApp()
    {
        return $this->hasOne(App::class, 'oauth_client_id');
    }

    /**
     * Determine if the client is a first-party client.
     */
    public function firstParty(): bool
    {
        return $this->confidential && $this->redirect === null; // First-party clients are confidential and have no redirect URI
    }


    public function pendingTesters()
    {
        return $this->testers()->pending();
    }

    public function acceptedTesters()
    {
        return $this->testers()->accepted();
    }

    public function rejectedTesters()
    {
        return $this->testers()->rejected();
    }

    public function getTesterCount()
    {
        return $this->testers()->count();
    }

    public function canAddMoreTesters($limit = 50)
    {
        return $this->getTesterCount() < $limit;
    }
}
