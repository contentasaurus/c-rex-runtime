<?php

use \puffin\model\pdo as pdo;
use \puffin\model as Model;

class history extends pdo
{
	protected $connection = 'default';
	protected $table = 'page_history';
}
