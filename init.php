<?php

use \puffin\session as session;
use \puffin\app as app;
use \puffin\view as view;
use \puffin\autoload as autoload;

define('SERVER_ROOT', dirname(__FILE__));

define('APP_PATH', SERVER_ROOT.'/app');
define('CONTROLLER_PATH', APP_PATH.'/controllers');
define('TRANSFORMER_PATH', APP_PATH.'/transformers');
define('MODEL_PATH', APP_PATH.'/models');
define('PLUGIN_PATH', APP_PATH.'/plugins');
define('TEST_PATH', APP_PATH.'/tests');
define('VIEW_PATH', APP_PATH.'/views');
define('PARTIAL_PATH', VIEW_PATH.'/partials');
define('LAYOUT_PATH', VIEW_PATH.'/layouts');
define('SCRIPT_PATH', VIEW_PATH.'/scripts');
define('TEMPLATE_PATH', VIEW_PATH.'/templates');
define('PUBLIC_PATH', SERVER_ROOT.'/public');
define('UPLOAD_PATH', PUBLIC_PATH.'/uploads');
define('VENDOR_PATH', SERVER_ROOT.'/vendor');
define('SYSTEM_PATH', VENDOR_PATH.'/puffin');

define('ERROR_REPORTING', true);

############################################

require VENDOR_PATH . '/autoload.php';

############################################

define('DB_NAME', 'crex_runtime');
define('DB_USER', 'crex_runtime');
define('DB_PASSWORD', 'password');
define('DB_ADDRESS', '127.0.0.1');

############################################

session::start();
autoload::init();
view::init('php');

$app = new app();
$app->router();
require 'app/app.php';
$app->route();

echo $app->render();

exit;
