<?php

use \puffin\plugin as plugin;
use \puffin\view as view;
use \puffin\debug as debug;
use \puffin\url as url;
use \puffin\dsn as dsn;

# Handy Shortcut functions
function debug( $input ){ echo debug::printr($input); }
function clog( $input ){ echo debug::clog($input); }
function redirect( $location = false ){ url::redirect($location); }
function vd($arg) { 
	ob_start();
	echo var_dump($arg);
	$output = ob_get_clean();
	$output = htmlentities($output);
	echo '<pre>'.$output.'</pre>'; 
}

dsn::set('default', [
	'type' => 'mysql',
	'name' => DB_NAME,
	'user' => DB_USER,
	'pass' => DB_PASSWORD,
	'addr' => DB_ADDRESS
]);

#Plugins
// plugin::register('bower');
// plugin::register('theme');
// plugin::register('forceauth');
// plugin::register('fonts');
// plugin::register('layout');

#Routes
include_once 'routes.php';
