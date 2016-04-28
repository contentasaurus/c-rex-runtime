<?php

use \puffin\model\pdo as pdo;
use \puffin\model as Model;

class tag extends pdo
{
	protected $connection = 'default';
	protected $table = 'dam_tags';
}
