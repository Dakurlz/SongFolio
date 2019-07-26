<?php

declare (strict_types = 1);

namespace Songfolio\Core\Oauth;

use Songfolio\Models\Settings;
use Songfolio\Core\Helper;
use Songfolio\Core\Oauth\ProviderInterface;

abstract class Provider implements ProviderInterface
{
    protected $client_id;
    protected $client_secret;

    public function __construct(){
        $site_settings = Settings::get('config')->__get('data');
        if(isset($site_settings['oauth'][$this->getProviderName()])){
            $this->client_id = $site_settings['oauth'][$this->getProviderName()]['client_id'];
            $this->client_secret = $site_settings['oauth'][$this->getProviderName()]['client_secret'];
        }
    }

    public function getProviderName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }


    public function getAuthorizationUrl(): string
    {
        if($this->client_id && $this->client_secret){
            $state = $this->getNewState();
            return $this->authUrl."?client_id={$this->client_id}&response_type=code&redirect_uri={$this->getRedirectUrl()}&state={$state}&scope={$this->scopes}";
        }

        return '';
    }

    public function getAccessTokenUrl($code_parameter): string
    {
        if ($_GET['state'] === $_SESSION['state']) {
            $token_url = $this->tokenUrl."?client_id={$this->client_id}&redirect_uri={$this->getRedirectUrl()}&client_secret={$this->client_secret}&code={$code_parameter}&grant_type=authorization_code";
            $result = Helper::curl_request($token_url);
            
            // car github return string
            if(!Helper::isJSON($result)){
                $access_token_git = explode('=',explode('&',$result)[0])[1];
                return $access_token_git;
            }
            
            return json_decode($result, true)['access_token'];
        }else{
            return 'State invalid';
        }
    }

    public function getNewState(){
        $_SESSION['state'] = bin2hex(random_bytes(30));
        return $_SESSION['state'];
    }

    public function getRedirectUrl(){
        return urlencode(Helper::host().'login/oauth?provider='.$this->getProviderName());
    }
}