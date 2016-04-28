<?php

use \puffin\model\pdo as pdo;
use \puffin\model as Model;

class role extends pdo
{
	protected $connection = 'default';
	protected $table = 'roles';
}
