<?php
namespace Craft;

class ProgressivePlugin extends BasePlugin
{
    public function getName()
    {
        $pluginNameOverride = $this->getSettings()->getAttribute('pluginNameOverride');
        return empty($pluginNameOverride) ? Craft::t('Progressive') : $pluginNameOverride;
    }

    public function getDescription()
    {
        return 'Simple setup configuration for enabling progressive web applications.';
    }

    public function getDocumentationUrl()
    {
        return 'https://github.com/kriden/';
    }

    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/kriden/progressive/master/releases.json';
    }

    public function getVersion()
    {
        return '1.3.1';
    }

    // public function getSchemaVersion()
    // {
    //     return '1.5.20';
    // }

    public function getDeveloper()
    {
        return 'KRI8';
    }

    public function getDeveloperUrl()
    {
        return 'https://www.kri8.be';
    }

    public function hasCpSection()
    {
        return false;
    }

    public function init()
    {

        craft()->templates->hook('progressiveRender', function(&$context)
        {

        });
    }


    public function registerSiteRoutes()
    {
        return array(
            'manifest.json' => array('action' => 'progressive/renderManifest'),
            'serviceworker.js' => array('action' => 'progressive/renderServiceWorker'),
        );
    }

    public function registerCpRoutes()
    {
        return array(
            'progressive/welcome' => array('action' => 'progressive/welcome'),
            'progressive/settings' => array('action' => 'progressive/settings')
        );
    }

    function getSettingsUrl()
    {
        return 'progressive/settings';
    }

    /**
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'pluginNameOverride'  => AttributeType::String
        );
    }

    public function onAfterInstall()
    {
        /* -- Show our "Welcome to SEOmatic" message */
        if (!craft()->isConsole())
            craft()->request->redirect(UrlHelper::getCpUrl('progressive/welcome'));

    }

} /* -- class SeomaticPlugin */
