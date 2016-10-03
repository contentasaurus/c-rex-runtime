<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\controller\action as action;
use \puffin\split_resolver as split_resolver;

class runtime_controller extends action
{
	private $page_data = [
		'PAGE' => [],
		'DATA' => []
	];
	
	public function __construct() 
	{
		// works here but not in any controller method, 
		// constrains each controller to a specific response view type
		view::init('handlebars');
	}

	public function index($permalink = '/')
	{
		$page = new page();
		$pages = $page->get_by_permalink($permalink);
		$this_page = $this->resolve_page($pages);

		if(!!$this_page['compiled_lightncandy']) {
			$page_data = $page->get_data($this_page['page']);
			$this->resolve_data($page_data);
			view::add_params($this->page_data);
			view::renderer($this_page['compiled_lightncandy']); 
		}
		else {
			view::html($this_page['contents']);
		}
	}

	private function resolve_page($pages) 
	{
		$page = null;

		if(count($pages) > 1) {
			$splits = [];
			foreach($pages as $key => $p) {
				$splits[$key] = $p['percentage'];
			}
			$decision = split_resolver::resolve($splits);
			$page = $pages[$decision];
		}
		else {
			$page = reset($pages);
		}

		$this->page_data['PAGE']['permalink'] = $page['permalink'];
		$this->page_data['PAGE']['title'] = $page['title'];

		return $page;
	}

	private function resolve_data($data) 
	{
		foreach ($data as $key => $value) {
			$content = json_decode($value['content']);
			$name = $value['reference_name'];
			$this->page_data['DATA'][$name] = $content;
		}
	}
}
