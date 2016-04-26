<?php

namespace puffin;

$app->any('/', function( $action = 'index' ){

	controller::init( 'index', get_defined_vars());
	controller::dispatch( 'index' );

});

$app->any('/test', function( $action = 'index' ){

	controller::init( 'test', get_defined_vars());
	controller::dispatch( 'index' );

});
