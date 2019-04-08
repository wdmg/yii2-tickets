<?php

namespace wdmg\tickets;

/**
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @copyright       Copyright (c) 2019 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 */

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
                $prefix . '<module:tickets>/<controller:(list|item)>/' => '<module>/<controller>',
                $prefix . '<module:tickets>/<controller:(list|item)>/<action:\w+>' => '<module>/<controller>/<action>',
                [
                    'pattern' => $prefix . '<module:tickets>/',
                    'route' => '<module>/list/all',
                    'suffix' => '',
                ], [
                    'pattern' => $prefix . '<module:tickets>/<controller:(list|item)>/',
                    'route' => '<module>/<controller>',
                    'suffix' => '',
                ], [
                    'pattern' => $prefix . '<module:tickets>/<controller:(list|item)>/<action:\w+>',
                    'route' => '<module>/<controller>/<action>',
                    'suffix' => '',
                ],
            ],
            true
        );
    }
}
