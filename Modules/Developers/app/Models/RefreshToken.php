<?php

namespace Modules\Developers\Models;

use Laravel\Passport\RefreshToken as PassportRefreshToken;

class RefreshToken extends PassportRefreshToken
{
    protected $table = 'developers.oauth_refresh_tokens';
}
