<?php

use \puffin\model\pdo as pdo;
use \puffin\model as Model;

class collection extends pdo
{
	protected $connection = 'default';
	protected $table = 'collections';
}
