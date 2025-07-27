<?php

namespace Modules\Developers\Models;

use Laravel\Passport\Client as BaseClient;
use Modules\Developers\Models\AppTester;

class Client extends BaseClient
{
    /**
     * Determine if the client should skip the authorization prompt.
     */
    /* public function skipsAuthorization(): bool
    {
        return $this->firstParty();
    } */

    public function testers()
    {
        return $this->hasMany(AppTester::class, 'oauth_client_id');
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
