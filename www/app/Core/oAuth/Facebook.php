<?php

declare (strict_types = 1);

namespace Songfolio\Core\Oauth;

class Facebook extends Provider
{
    private $oAuthUrl = 'https://www.facebook.com/v3.3/dialog/';

    public function getAuthorizationUrl(): string
    {
        if($this->client_id && $this->client_secret){
            $_SESSION['state'] = bin2hex(random_bytes(30));
            return $this->oAuthUrl."oauth?client_id={$this->client_id}&redirect_uri={$this->getRedirectUrl()}&state={$_SESSION['state']}&scope=email";
        }else{
            return '';
        }
    }

    public function getAccessTokenUrl($code_parameter): string
    {
        if ($_GET['state'] === $_SESSION['state']) {
            $token_url = "https://graph.facebook.com/v3.3/oauth/access_token?client_id={$this->client_id}&redirect_uri={$this->getRedirectUrl()}&client_secret={$this->client_secret}&code={$code_parameter}";

            $result = $this->request($token_url);

            return json_decode($result, true)['access_token'];
        }else{
            return 'State invalid';
        }
    }

    public function getUsersInfo($token_access):string
    {
        return $this->request("https://graph.facebook.com/me?access_token={$token_access}&fields=id,first_name,last_name,email");
    }
}