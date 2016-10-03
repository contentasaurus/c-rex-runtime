<?php

use \puffin\model\pdo as pdo;

class page extends pdo
{
	protected $table = 'dual';

	public function get_by_permalink($permalink)
	{
		$sql = "SELECT * FROM pages WHERE permalink = :permalink";
		$params = [':permalink' => $permalink];
		$result = $this->select($sql, $params);
		return $result;
	}

	public function get_data($page_ref)
	{
		$sql = "SELECT * FROM page_data WHERE page = :page";
		$params = [':page' => $page_ref];
		$result = $this->select($sql, $params);
		return $result;
	}
}
