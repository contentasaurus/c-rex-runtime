<?php

use \puffin\model\pdo as pdo;
use \puffin\model as Model;

class log extends pdo
{
	protected $connection = 'default';
	protected $table = 'page_logs';
}
