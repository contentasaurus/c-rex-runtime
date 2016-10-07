<?php

$app->controller('runtime')
	->any('/{permalink:[a-zA-Z0-9\/\-\_]*}?', 'index');
