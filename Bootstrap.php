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
                $prefix . '<module:tickets>/' => '<module>/list/all',
                $prefix . '<module:tickets>/<controller:(list)>/' => '<module>/<controller>',
                $prefix . '<module:tickets>/<controller:(list)>/<action:(all|my|current)>' => '<module>/<controller>/<action>',
                $prefix . '<module:tickets>/<controller:(item)>/<action:(view|update|delete)>' => '<module>/<controller>/<action>',
            ],
            true
        );
    }
}
