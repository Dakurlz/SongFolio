<?php

declare (strict_types = 1);

namespace Songfolio\Core\Oauth;

abstract class Provider implements ProviderInterface
{
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