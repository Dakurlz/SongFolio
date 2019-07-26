<?php

declare (strict_types = 1);

namespace Songfolio\Core\Oauth\Providers;

use Songfolio\Core\Helper;
use Songfolio\Core\Oauth\Provider;

class Github extends Provider
{
    protected $authUrl = 'https://github.com/login/oauth/authorize';
    protected $tokenUrl = 'https://github.com/login/oauth/access_token';
    protected $infosUrl = 'https://api.github.com/user';
    protected $scopes = 'email';

    public function getUsersInfo($token_access):string
    {

        return Helper::curl_get($this->infosUrl, $token_access);
      
    }
}