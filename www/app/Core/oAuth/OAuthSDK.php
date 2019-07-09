<?php

declare (strict_types = 1);

namespace Songfolio\Core\Oauth;

use Songfolio\Models\Settings;

class OAuthSDK
{
    private $providers;

    public function __construct(){
        $settings = Settings::get('config')->__get('data');
        if(isset($settings['oauth'])){
            foreach($settings['oauth'] as $provider_name => $values){
                $class = 'Songfolio\Core\Oauth\Providers\\'.$provider_name;
                $this->providers[$provider_name] = new $class();
            }
        }
    }
    public function loadProvider(){
    }

    public function addProvider(){
    }

    public function getConnectionLinks(){
        if($this->providers != null){
            foreach($this->providers as $provider_name => $provider){
                $return[$provider_name] = $provider->getAuthorizationUrl();
            }
            return $return;
        }

        return [];
    }
    public function getUserInfos(){
        //Retourne les users info
    }
}