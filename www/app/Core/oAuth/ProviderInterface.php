<?php

namespace Songfolio\Core\Oauth;

interface ProviderInterface {
    /**
     * Return the provider name
     * @example google, facebook, ...
     */
    public function getProviderName(): string;

    /**
     * Return the authorization endpoint
     * @example http://auth-server/auth
     */
    public function getAuthorizationUrl(): string;

    /**
     * Return the access token endpoint
     * @example http://auth-server/token
     */
    public function getAccessTokenUrl($code_parameter): string;

    /**
     * Return the user information
     * @example [
     *  "id" => "123456",
     *  "name" => "John Smith",
     *  "email" => "john.smith@domain.com"
     * ]
     */
    public function getUsersInfo($token_access):string;
}