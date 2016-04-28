<?php

use \puffin\model as model;
use \puffin\view as view;

class index_controller extends puffin\controller\action
{
	public function __construct(){}

	public function index( $permalink )
	{
		$data = [];

		$page_model = new page();
		$page = $page_model->get_by_permalink( $permalink );

		if( $page->count() )
		{
			view::add_params( $page );

			// $data['page'] = $page->first();
			// $data['page']->content = $this->replaceModule($data['page']->content);
			//
			// return $this->checkIfPublished($data['page'], View::make($this->getTemplate(), $data));

		}
		else
		{
			view::layout('error page');
			view::template('error/error404');
		}

	}

}
