<?php

namespace Craft;

require_once(CRAFT_PLUGINS_PATH . 'azure/vendor/autoload.php');

class AzurePlugin extends BasePlugin
{
    /**
     * Get Name
     */
    public function getName()
    {
        return Craft::t('Azure');
    }

    /**
     * Plugins description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('Azure AD Provider for OAuth');
    }

    /**
     * Get Version
     */
    public function getVersion()
    {
        return '2.0.0';
    }

    /**
     * Get Developer
     */
    public function getDeveloper()
    {
        return 'Jason McCallister';
    }

    /**
     * Get Developer URL
     */
    public function getDeveloperUrl()
    {
        return 'https://mccallister.io';
    }

    /**
     * Returns required plugins
     *
     * @return array Required plugins
     */
    public function getRequiredPlugins()
    {
        return array(
            array(
                'name' => "OAuth",
                'handle' => 'oauth',
                'url' => 'https://dukt.net/craft/oauth',
                'version' => '2.0.0'
            )
        );
    }

    /**
     * Get OAuth Providers
     */
    public function getOauthProviders()
    {
        require_once(CRAFT_PLUGINS_PATH . 'azure/providers/Azure.php');

        return [
            'Dukt\OAuth\Providers\Azure',
        ];

    }

    /**
     * Remove all tokens related to this plugin when uninstalled
     */
    public function onBeforeUninstall()
    {
        if (isset(craft()->oauth)) {
            craft()->oauth->deleteTokensByPlugin('azure');
        }
    }
}