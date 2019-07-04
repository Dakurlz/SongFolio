<?php

declare (strict_types = 1);

namespace Songfolio\Core\Oauth\Providers;

use Songfolio\Core\Helper;
use Songfolio\Core\Oauth\Provider;

class Google extends Provider
{
    protected $authUrl = 'https://accounts.google.com/o/oauth2/v2/auth';
    protected $tokenUrl = 'https://www.googleapis.com/oauth2/v4/token';
    protected $infosUrl = 'https://www.googleapis.com/oauth2/v3/userinfo';
    protected $scopes = 'https://www.googleapis.com/auth/userinfo.profile';

    public function getUsersInfo($token_access):string
    {
        return Helper::curl_request($this->infosUrl."?access_token={$token_access}");
    }
}