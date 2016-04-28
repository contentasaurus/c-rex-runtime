<?php

use \puffin\model\pdo as pdo;
use \puffin\model as Model;

class type extends pdo
{
	protected $connection = 'default';
	protected $table = 'page_types';
}
