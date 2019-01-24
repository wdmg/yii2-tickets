<?php

namespace wdmg\tickets;

use Yii;

/**
 * tickets module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'wdmg\tickets\controllers';

    /**
     * {@inheritdoc}
     */
    public $defaultRoute = 'list';

    /**
     * @var string the prefix for routing of module
     */
    public $routePrefix = "admin";

    /**
     * @var string the vendor name of module
     */
    public $vendor = "wdmg";

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // Set controller namespace for console commands
        if (Yii::$app instanceof \yii\console\Application)
            $this->controllerNamespace = 'wdmg\rbac\commands';

        // Register translations
        $this->registerTranslations();
    }

    // Registers translations for the module
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['app/modules/tickets'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/wdmg/yii2-tickets/messages',
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('app/modules/tickets' . $category, $message, $params, $language);
    }
}