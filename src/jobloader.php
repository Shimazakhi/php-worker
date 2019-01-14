<?php

/*
 * Application Dir location
 */

define('BASEPATH', dirname(__FILE__).'/../../');


/*
 * Environment config management bootstrapping
 */
$dotenv = new Dotenv\Dotenv(BASEPATH);

$dotenv->load();

/*
 * Database connection bootstrapping
 */

use Illuminate\Database\Capsule\Manager as Database;

$database = new Database;

$database->addConnection([
    'driver' => getenv('DB_CONNECTION', 'mysql'),
    'host' => getenv('DB_HOST', 'localhost'),
    'database' => getenv('DB_DATABASE', 'database'),
    'username' => getenv('DB_USERNAME', 'root'),
    'password' => getenv('DB_PASSWORD', 'default'),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'timezone' => '+00:00',
    'strict' => false,
]);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$database->setEventDispatcher(new Dispatcher(new Container));

$database->bootEloquent();

$database->setAsGlobal();
