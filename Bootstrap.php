<?php

namespace wdmg\tickets;

use yii\base\BootstrapInterface;
use Yii;


class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // Get the module instance
        $module = Yii::$app->getModule('tickets');

        // Get URL path prefix if exist
        $prefix = (isset($module->routePrefix) ? $module->routePrefix . '/' : '');

        // Add module URL rules
        $app->getUrlManager()->addRules(
            [
                $prefix.'<controller:(tickets|attachments|messages)>/' => 'tickets/<controller>/index',
                $prefix.'tickets/<controller:(tickets|attachments|messages)>/<action:\w+>' => 'tickets/<controller>/<action>',
                $prefix.'<controller:(tickets|attachments|messages)>/<action:\w+>' => 'tickets/<controller>/<action>',
            ],
            false
        );
    }
}
