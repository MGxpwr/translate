<?php
/**
 * Translate settings Controller.
 *
 * Contains translate settings request actions.
 */

namespace Craft;

use SoapClient;
use Exception;
use stdClass;

class Translate_SettingsController extends BaseController
{
    /**
     * Loads the settings Template
     * @throws HttpException
     */
    public function actionEdit()
    {
        $variable['settings'] = craft()->plugins->getPlugin('translate')->getSettings();
        $this->renderTemplate('translate/settings/general', $variable);
    }

    /**
     * Save setting changes
     * @throws HttpException
     */
    public function actionSave()
    {
        // Post is required
        $this->requirePostRequest();
        // Put the post data in an array
        $postData['translationPath'] = craft()->request->getPost('translationPath');

        // Clean the path
        $postData['translationPath'] = IOHelper::cleanPath($postData['translationPath']);

        // get the plugin
        $plugin = craft()->plugins->getPlugin('translate');
        // Save the settings in the craft settings table
        if (craft()->plugins->savePluginSettings($plugin, $postData)) {
            // Great success Settings saved
            craft()->userSession->setNotice(Craft::t("Settings Saved"));
            // Redirect to given url
            $this->redirectToPostedUrl();
        } else {
            // Something went wrong set notification for user
            craft()->userSession->setError(Craft::t("Settings not saved"));
        }
    }
}