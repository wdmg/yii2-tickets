# Yii2 Tickets Module
Ticket system for Yii2

# Installation
To install the module, run the following command in the console:

`$ composer require "wdmg/yii2-tickets:1.0.0"`

# Migrations
To execute the migration and create the initial data, run the following command in the console:

`$ yii migrate --migrationPath=@vendor/wdmg/yii2-tickets/migrations`

# Configure

To add a module to the project, add the following data in your configuration file:

    'modules' => [
        ...
        'tasks' => [
            'class' => wdmg\tickets\Module::className(),
        ],
        ...
    ],

# Status
Module in progress development.