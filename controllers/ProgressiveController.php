<?php

namespace Craft;

class ProgressiveController extends BaseController {

    private static $PLUGIN_NAME = "progressive";

    protected $allowAnonymous = array('actionRenderManifest');

    /**
     * Welcome action - displayed when plugin is first installed.
     */
    public function actionWelcome()
    {
        $this->renderTemplate('progressive/welcome', array());
    } /* -- actionWelcome */


    public function actionSettings() {
        $locale = craft()->language;
        $model = craft()->progressive->getSettings();
        $settings = $model->getAttributes();

        $variables = array(
            'settings' => $settings,
            'elements' => array(),
            'iconImageId' => '',
            'elementType' => craft()->elements->getElementType(ElementType::Asset),
            'locale' => $locale
        );

        // Whether any assets sources exist
        $sources = craft()->assets->findFolders();
        $variables['assetsSourceExists'] = count($sources);

        $this->renderTemplate('progressive/settings', $variables);
    } /* -- actionSettings */

    public function actionSaveSettings() {
        $this->requirePostRequest();

        $model = craft()->progressive->getSettings();
        $model->setAttributes(craft()->request->getPost());

        if (craft()->progressive->saveSettings($model)) {
            craft()->userSession->setNotice(Craft::t('Settings saved.'));
        }
    }

    /**
    *	Render Manifest action - used to build manifest file.
    */
    public function actionRenderManifest() {
        $oldPath = craft()->templates->getTemplatesPath();
        $newPath = craft()->path->getPluginsPath().'progressive/templates';

        craft()->templates->setTemplatesPath($newPath);
        $this->renderTemplate('manifest', array());
        craft()->templates->setTemplatesPath($oldPath);
    } /* -- renderManifest */


}