<?php

namespace Modules\Developers\Models;

use Laravel\Passport\DeviceCode as PassportDeviceCode;

class DeviceCode extends PassportDeviceCode
{
    protected $table = 'developers.oauth_device_codes';
}
