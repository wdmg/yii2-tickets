<?php

namespace wdmg\tickets;

use yii\base\BootstrapInterface;


class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // Add module URL rules.
        $app->getUrlManager()->addRules(
            [
                'admin/<_m>' => '<_m>/admin/index',
            ],
            false
        );

        /*$app->controllerMap["migrate"]["class"] = 'yii\console\controllers\MigrateController';
        $app->controllerMap["migrate"]["migrationNamespaces"][] = 'wdmg\tickets\migrations';*/
    }
}
