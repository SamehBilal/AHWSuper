<?php

namespace Modules\Developers\Models;

use Laravel\Passport\Token as PassportToken;

class Token extends PassportToken
{
    protected $table = 'developers.oauth_access_tokens';
}
