<?php

/*
 * Application Dir location
 */

define('BASEPATH', dirname(__FILE__).'/');
ini_set('display_errors', 1);
/*
 * PHP Detect line endings for MAC files
 */
if (! ini_get("auto_detect_line_endings")) {
    ini_set("auto_detect_line_endings", '1');
}

require_once __DIR__.'/vendor/autoload.php';

/*
 * dd helper bootstrapping
 */
require __DIR__.'/vendor/larapack/dd/src/helper.php';

/*
 * Environment config management bootstrapping
 */
$dotenv = new Dotenv\Dotenv(__DIR__);

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
