<?php

namespace Craft;

class ProgressiveController extends BaseController {

    private static $PLUGIN_NAME = "progressive";

    protected $allowAnonymous = array('actionRenderManifest', 'actionRenderServiceWorker');

    /**
     * Renders the welcome template
     * @return void
     */
    public function actionWelcome()
    {
        $this->renderTemplate('progressive/welcome', array());
    } /* -- actionWelcome */


    /**
     * Renders the setting page
     * @return void
     */
    public function actionSettings() {
        $locale = craft()->language;
        $model = craft()->progressive->getSettings();
        $settings = $model->getAttributes();

        $variables = array(
            'settings' => $settings,
            'elements' => array(craft()->elements->getElementById($model->iconImageId)),
            'iconImageId' => $model->iconImageId,
            'elementType' => craft()->elements->getElementType(ElementType::Asset),
            'locale' => $locale
        );

        // Whether any assets sources exist
        $sources = craft()->assets->findFolders();
        $variables['assetsSourceExists'] = count($sources);

        $this->renderTemplate('progressive/settings', $variables);
    } /* -- actionSettings */

    /**
     * Saves plugin settings
     * @return void
     */
    public function actionSaveSettings() {
        $this->requirePostRequest();

        $model = craft()->progressive->getSettings();
        $model->setAttributes(craft()->request->getPost());

        $iconImage = craft()->request->getPost('iconImageId');
        if(is_array($iconImage)) $model->setAttribute("iconImageId", $iconImage[0]);
    
        if (craft()->progressive->saveSettings($model)) {
            craft()->userSession->setNotice(Craft::t('Settings saved.'));
        }
    }

    /**
     * Renders manifest file
     * @return void
     */
    public function actionRenderManifest() {
        $oldPath = craft()->templates->getTemplatesPath();
        $newPath = craft()->path->getPluginsPath().'progressive/templates';

        craft()->templates->setTemplatesPath($newPath);
        $this->renderTemplate('manifest', array());
        craft()->templates->setTemplatesPath($oldPath);
    } /* -- renderManifest */


    /**
     * Renders service worker
     * @return void
     */
    public function actionRenderServiceWorker() {
        $settings = craft()->progressive->getSettings();

        $oldPath = craft()->templates->getTemplatesPath();
        $newPath = craft()->path->getPluginsPath().'progressive/templates';

        $vars = array(
            'cacheName' => str_replace(' ','-', strtolower($settings->short_name)),
            'offlineCache' => json_encode(array_merge(split(",", $settings->cached_files), array("/", $settings->start_url)))
        );

        craft()->templates->setTemplatesPath($newPath);
        $this->renderTemplate('serviceworker', $vars);
        craft()->templates->setTemplatesPath($oldPath);
    } /* -- renderManifest */


}