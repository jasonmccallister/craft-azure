<?php

namespace Dukt\OAuth\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Entity\User;

class Azure extends AbstractProvider
{
    /**
     * The URL to retrieve authorization.
     *
     * @return string
     */
    public function urlAuthorize()
    {
        return 'https://login.microsoftonline.com/common/oauth2/authorize';
    }

    /**
     * The URL to retreive the access token.
     *
     * @return string
     */
    public function urlAccessToken()
    {
        return 'https://login.microsoftonline.com/common/oauth2/token';
    }

    /**
     * TODO determine if Azure exposes this anywhere.
     *
     * @param \League\OAuth2\Client\Token\AccessToken $token
     * @return string
     */
    public function urlUserDetails(\League\OAuth2\Client\Token\AccessToken $token)
    {
        return $token;
        // return 'https://slack.com/api/api.test?access_token='.$token;
    }

    /**
     * @param object $response
     * @param \League\OAuth2\Client\Token\AccessToken $token
     * @return User
     */
    public function userDetails($response, \League\OAuth2\Client\Token\AccessToken $token)
    {
        $user = new User;
        $user->uid = substr($response->uri, strrpos($response->uri, "/") + 1);
        $user->name = $response->name;
        return $user;
    }
}
