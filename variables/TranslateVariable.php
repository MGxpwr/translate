<?php
/**
 * Translate plugin for Craft CMS
 *
 * Translate Variable
 */

namespace Craft;

class TranslateVariable
{
    /**
     * @return BasePlugin|null
     */
    public function getPlugin()
    {
        return craft()->plugins->getPlugin('translate');
    }

    /**
     * @return mixed
     */
    public function getPluginName()
    {
        return $this->getPlugin()->getName();
    }
}