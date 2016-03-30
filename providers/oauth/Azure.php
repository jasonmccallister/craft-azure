<?php

namespace Dukt\OAuth\Providers;

use Craft\Craft;
use Craft\UrlHelper;
use Craft\Oauth_TokenModel;

class Azure extends BaseProvider
{
    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return 'Azure';
    }

    /**
     * Get Icon URL
     *
     * @return string
     */
    public function getIconUrl()
    {
        return UrlHelper::getResourceUrl('azure/icon.svg');
    }

    /**
     * Get OAuth Version
     *
     * @return int
     */
    public function getOauthVersion()
    {
        return 2;
    }

    /**
     * Get API Manager URL
     *
     * @return string
     */
    public function getManagerUrl()
    {
        return 'https://manage.windowsazure.com/';
    }

    /**
     * Get Scope Docs URL
     *
     * @return string
     */
    public function getScopeDocsUrl()
    {
        return 'https://azure.microsoft.com/en-us/documentation/articles/active-directory-v2-scopes/';
    }

    /**
     * Crete the OAuth Provider.
     * 
     * @return \Dukt\OAuth\OAuth2\Client\Provider\Azure
     */
    public function createProvider()
    {
        $config = require_once(CRAFT_PLUGINS_PATH . 'azure/config.php');

        $provider = [
            'clientId' => $this->providerInfos->clientId,
            'clientSecret' => $this->providerInfos->clientSecret,
            'redirectUri' => $this->getRedirectUri(),
            'resource' => $config['resource']
        ];

        return new \Dukt\OAuth\OAuth2\Client\Provider\Azure($provider);
    }

    /**
     * Create Subscriber
     */
    public function createSubscriber(Oauth_TokenModel $token)
    {
        $infos = $this->getInfos();

        return new \Dukt\OAuth\Guzzle\Subscribers\Azure([
            'access_token' => $token->accessToken,
        ]);
    }
}
