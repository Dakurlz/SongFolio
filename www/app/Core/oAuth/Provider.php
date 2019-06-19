<?php

declare (strict_types = 1);

namespace Songfolio\Core\Oauth;

use Songfolio\Models\Settings;

abstract class Provider implements ProviderInterface
{
    //protected $client_id = '2232449167069840';
    //protected $client_secret = 'ec07adea3bce25a26d3fdcb3b5baa5f2';
    protected $client_id;
    protected $client_secret;

    public function __construct(){
        $site_settings = (new Settings('config'))->get();
        if(isset($site_settings['oauth_id_'.$this->getProviderName()]) && isset($site_settings['oauth_secret_'.$this->getProviderName()])){
            $this->client_id = $site_settings['oauth_id_'.$this->getProviderName()];
            $this->client_secret = $site_settings['oauth_secret_'.$this->getProviderName()];
        }
    }

    public function getProviderName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    public function getNewState(){
        $_SESSION['state'] = bin2hex(random_bytes(30));
        return $_SESSION['state'];
    }

    public function getRedirectUrl(){
        return urlencode(BASE_URL.'login/oauth?provider='.$this->getProviderName());
    }

    public function request($url){
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HEADER, 0);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($handle);
        if(curl_errno($handle))
        {
            echo 'Curl error: ' . curl_error($handle);
        }
        curl_close($handle);

        return $result;
    }
}