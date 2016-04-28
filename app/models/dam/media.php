<?php

use \puffin\model\pdo as pdo;
use \puffin\model as Model;

class media extends pdo
{
	protected $connection = 'default';
	protected $table = 'dam_media';
}
