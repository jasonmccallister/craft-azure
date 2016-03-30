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
     * Get Version
     */
    public function getVersion()
    {
        return '1.0.0';
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
     * Define the URL to the releases.
     *
     * @return string URL to the releases.json
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/themccallister/craft-azure/master/releases.json';
    }

    /**
     * Returns required plugins
     *
     * @return array Required plugins
     */
    public function getRequiredPlugins()
    {
        return [
            [
                'name' => "OAuth",
                'handle' => 'oauth',
                'url' => 'https://dukt.net/craft/oauth',
                'version' => '1.0.0'
            ]
        ];
    }

    /**
     * Get OAuth Providers
     */
    public function getOauthProviders()
    {
        return [
            'Dukt\OAuth\Providers\Azure'
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
