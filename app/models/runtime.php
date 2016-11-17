<?php

use \puffin\model\pdo as pdo;

class runtime extends pdo
{
	protected $table = 'dual';

	public function get_by_permalink( $permalink )
	{
		$sql = 'SELECT *
				FROM pages
				WHERE permalink = :permalink';

		$params = [
			':permalink' => $permalink
		];

		return $this->select( $sql, $params );
	}

	public function get_data( $page_ref )
	{
		$sql = 'SELECT *
				FROM page_data
				WHERE page = :page';

		$params = [
			':page' => $page_ref
		];

		$data = $this->select($sql, $params);

		$return = [];
		foreach( $data as $datum )
		{
			$return[$datum['reference_name']] = json_decode($datum['content'], $assoc = true);
		}

		return $return;

	}

	public function resolve_split( $splits = [] )
	{
		if( !count($splits) )
		{
			throw new Exception('No splits passed in.');
			return null;
		}

		if( count($splits) == 1 )
		{
			return array_keys($splits)[0];
		}

		if( array_sum($splits) != 100 )
		{
			throw new Exception('Sum of array values does not add up to 100.');
			return null;
		}

		krsort($splits);

		$outcomes = [];
		$remainder = 100;
		$choice = mt_rand(0, $remainder);
		$reversed_splits = array_reverse($splits);

		foreach( $reversed_splits as $key => $value )
		{
			$outcomes[$key] = [($remainder - $value), $remainder];
			$remainder = $remainder - $value;
		}

		foreach( $outcomes as $key => $value )
		{
			$min = $value[0];
			$max = $value[1];

			// removes overlapping edges of the ranges
			if($min != 0) $min++;

			if( $choice <= $max && $choice >= $min )
			{
				return $key;
			}
		}
	}

	public function get_current_key()
	{
		return $this->select_one( 'SELECT deployment_key FROM ___recent_deployments WHERE is_current = 1' );
	}

	public function get_scripts()
	{
		return $this->select( 'SELECT * FROM scripts' );
	}

	public function get_layouts() 
	{
		return $this->select( 'SELECT * FROM layouts' );
	}

}
