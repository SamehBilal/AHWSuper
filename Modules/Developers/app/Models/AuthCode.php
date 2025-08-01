<?php

namespace Modules\Developers\Models;

use Laravel\Passport\AuthCode as PassportAuthCode;

class AuthCode extends PassportAuthCode
{
    protected $table = 'developers.oauth_auth_codes';
}
