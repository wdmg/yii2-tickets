[![Progress](https://img.shields.io/badge/required-Yii2_v2.0.33-blue.svg)](https://packagist.org/packages/yiisoft/yii2)
[![Github all releases](https://img.shields.io/github/downloads/wdmg/yii2-tickets/total.svg)](https://GitHub.com/wdmg/yii2-tickets/releases/)
[![GitHub version](https://badge.fury.io/gh/wdmg%2Fyii2-tickets.svg)](https://github.com/wdmg/yii2-tickets)
![Progress](https://img.shields.io/badge/progress-in_development-red.svg)
[![GitHub license](https://img.shields.io/github/license/wdmg/yii2-tickets.svg)](https://github.com/wdmg/yii2-tickets/blob/master/LICENSE)

# Yii2 Tickets Module
Ticket system for Yii2

# Requirements 
* PHP 5.6 or higher
* Yii2 v.2.0.33 and newest
* [Yii2 Base](https://github.com/wdmg/yii2-base) module (required)
* [Yii2 Editor](https://github.com/wdmg/yii2-editor) module
* [Yii2 Tasks](https://github.com/wdmg/yii2-tasks) module (optionaly)
* [Yii2 Users](https://github.com/wdmg/yii2-users) module (optionaly)

# Installation
To install the module, run the following command in the console:

`$ composer require "wdmg/yii2-tickets"`

After configure db connection, run the following command in the console:

`$ php yii tickets/init`

And select the operation you want to perform:
  1) Apply all module migrations
  2) Revert all module migrations

# Migrations
In any case, you can execute the migration and create the initial data, run the following command in the console:

`$ php yii migrate --migrationPath=@vendor/wdmg/yii2-tickets/migrations`

# Configure
To add a module to the project, add the following data in your configuration file:

    'modules' => [
        ...
        'tickets' => [
            'class' => 'wdmg\tickets\Module',
            'routePrefix' => 'admin'
        ],
        ...
    ],

# Routing
Use the `Module::dashboardNavItems()` method of the module to generate a navigation items list for NavBar, like this:

    <?php
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
            'label' => 'Modules',
            'items' => [
                Yii::$app->getModule('tickets')->dashboardNavItems(),
                ...
            ]
        ]);
    ?>


# Status and version [in progress development]
* v.1.1.8 - Added pagination, up to date dependencies
* v.1.1.7 - Fixed deprecated class declaration
* v.1.1.6 - Added extra options to composer.json and navbar menu icon
* v.1.1.5 - Added choice param for non interactive mode
* v.1.1.4 - Module refactoring