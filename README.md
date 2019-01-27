[![Progress](https://img.shields.io/badge/required-Yii2_v2.0.13-blue.svg)](https://packagist.org/packages/yiisoft/yii2) [![Github all releases](https://img.shields.io/github/downloads/wdmg/yii2-tickets/total.svg)](https://GitHub.com/wdmg/yii2-tickets/releases/) [![GitHub version](https://badge.fury.io/gh/wdmg%2Fyii2-tickets.svg)](https://github.com/wdmg/yii2-tickets) ![Progress](https://img.shields.io/badge/progress-in_development-red.svg) [![GitHub license](https://img.shields.io/github/license/wdmg/yii2-tickets.svg)](https://github.com/wdmg/yii2-tickets/blob/master/LICENSE)

# Yii2 Tickets Module
Ticket system for Yii2

# Requirements 
* PHP 5.6 or higher
* Yii2 v.2.0.13 and newest
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

If you have connected the module not via a composer add Bootstrap section:

`
$config['bootstrap'][] = 'wdmg\tickets\Bootstrap';
`

# Routing
- `/admin/tickets/list/` - All tickets
- `/admin/tickets/list/all/` - Some as all tickets
- `/admin/tickets/list/my/` - Tickets in which an authorized user has been assigned
- `/admin/tickets/list/current/?id=100` - Tickets created by user
- `/admin/tickets/item/create/` - Create new ticket
- `/admin/tickets/item/view/?id=1` - View info of selected ticket by ID
- `/admin/tickets/item/update/?id=1` - Edit selected ticket by ID
- `/admin/tickets/item/delete/?id=1` - Delete selected ticket by ID


# Status and version
* v.1.0.4 - Bugfix and refactoring
* v.1.0.3 - Added base CRUD interface
* v.1.0.2 - Added routing path to Bootstrap.
* v.1.0.1 - Added migrations path to Bootstrap.
* v.1.0.0 - Module in progress development.