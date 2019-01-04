# Yii2 Tickets Module
Ticket system for Yii2

# Installation
To install the module, run the following command in the console:

`$ composer require "wdmg/yii2-tickets"`

# Migrations
To execute the migration and create the initial data, run the following command in the console:

`$ yii migrate --migrationPath=@vendor/wdmg/yii2-tickets/migrations`

# Configure

To add a module to the project, add the following data in your configuration file:

    'modules' => [
        ...
        'tickets' => [
            'class' => 'wdmg\tickets\Module',
        ],
        ...
    ],

# Status and version
v.1.0.1 - Added migrations path to Bootstrap.
v.1.0.0 - Module in progress development.