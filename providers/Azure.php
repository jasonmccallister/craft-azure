<?php

namespace Dukt\OAuth\Providers;

// require the BaseProvider from OAuth
require_once(CRAFT_PLUGINS_PATH . 'oauth/providers/BaseProvider.php');

use Craft\Craft;
use Craft\UrlHelper;
use Craft\Oauth_ResourceOwnerModel;
use Dukt\OAuth\Providers\BaseProvider;

class Azure extends BaseProvider
{
    protected $settings;

    /**
     * Azure Provider constructor.
     */
    public function __construct()
    {
        $this->settings = require_once CRAFT_PLUGINS_PATH . 'azure/config.php';
    }

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
     * Create Azure Provider
     *
     * @return League\OAuth2\Client\Provider\Azure
     */
    public function createProvider()
    {
        $providerConfig = [
            'clientId' => $this->providerInfos->clientId,
            'clientSecret' => $this->providerInfos->clientSecret,
            'resource' => $this->settings['resource']
        ];

        return new \TheNetworg\OAuth2\Client\Provider\Azure($providerConfig);
    }

    /**
     * Get API Manager URL
     *
     * @return string
     */
    public function getManagerUrl()
    {
        return 'https://manage.windowsazure.com';
    }

    /**
     * Get Scope Docs URL
     *
     * @return string
     */
    public function getScopeDocsUrl()
    {
        return 'https://developers.facebook.com/docs/facebook-login/permissions/v2.5';
    }
}