<?php

declare (strict_types = 1);

namespace Songfolio\Core\Oauth\Providers;

use Songfolio\Core\Helper;
use Songfolio\Core\Oauth\Provider;

class Facebook extends Provider
{
    protected $authUrl = 'https://www.facebook.com/v3.3/dialog/oauth';
    protected $tokenUrl = 'https://graph.facebook.com/v3.3/oauth/access_token';
    protected $infosUrl = 'https://graph.facebook.com/me';
    protected $scopes = 'email';

    public function getUsersInfo($token_access):string
    {
        return Helper::curl_request($this->infosUrl."?access_token={$token_access}&fields=id,first_name,last_name,email");
    }
}