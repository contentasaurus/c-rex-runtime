<?php

use \puffin\model\pdo as pdo;
use \puffin\model as Model;

class user extends pdo
{
	protected $connection = 'default';
	protected $table = 'users';
}
