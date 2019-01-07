# Yii2 Tickets Module
Ticket system for Yii2

#Requirements 
* PHP 5.6
* Yii2 (v.2.0.10)
* [Yii2 Tasks](https://github.com/wdmg/yii2-tasks) module (optionaly)
* Yii2 Users module (optionaly)

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
`http://example.com/admin/tickets` - Module dashboard

# Status and version
v.1.0.2 - Added routing path to Bootstrap.
v.1.0.1 - Added migrations path to Bootstrap.
v.1.0.0 - Module in progress development.