<?php

namespace wdmg\tickets;

/**
 * Yii2 Tickets
 *
 * @category        Module
 * @version         1.1.9
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-tickets
 * @copyright       Copyright (c) 2019 - 2021 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use wdmg\base\BaseModule;

/**
 * Tickets module definition class
 */
class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'wdmg\tickets\controllers';

    /**
     * {@inheritdoc}
     */
    public $defaultRoute = "list/all";

    /**
     * @var string, the name of module
     */
    public $name = "Tickets";

    /**
     * @var string, the description of module
     */
    public $description = "Support Ticket System";

    /**
     * @var string the module version
     */
    private $version = "1.1.9";

    /**
     * @var integer, priority of initialization
     */
    private $priority = 10;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // Set version of current module
        $this->setVersion($this->version);

        // Set priority of current module
        $this->setPriority($this->priority);

    }

    /**
     * {@inheritdoc}
     */
    public function dashboardNavItems($options = false)
    {
        $items = [
            'label' => $this->name,
            'url' => [$this->routePrefix . '/'. $this->id],
            'icon' => 'fa fa-fw fa-ticket-alt',
            'active' => in_array(\Yii::$app->controller->module->id, [$this->id])
        ];
        return $items;
    }

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        parent::bootstrap($app);
    }
}