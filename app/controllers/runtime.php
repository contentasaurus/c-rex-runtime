<?php

use \puffin\view as view;
use \puffin\file as file;
use \puffin\directory as directory;
use \puffin\controller\action as action;

class runtime_controller extends action
{
	public function __construct(){}

	public function __init()
	{
		$this->runtime = new runtime();
		$this->hbs = new handlebars();
	}

	public function index( $permalink = '/' )
	{
		if($permalink != '/')
		{
			$permalink = "/$permalink";
		}

		$pages = $this->runtime->get_by_permalink($permalink);

		$this_page = $this->do_split_test( $pages );

		if( !!$this_page['for_render'] )
		{
			$data = [
				'Site'    => $this->runtime->get_site_data(),
				'Page'    => $this->runtime->get_data( $this_page['page'] ),
				'Post'    => $this->post->params(),
				'Get'     => $this->get->params(),
				'Server'  => $_SERVER,
				'Session' => $_SESSION,
				'Cookie'  => $_COOKIE
			];
		}
		else
		{
			#go to error page
			die('Page not found!');
			exit;
		}

		$this->check_for_script_files();

		$html = $this->hbs->render( $this_page['for_render'], $data );

		view::layout('runtime');
		view::add_param( 'html', $html );
	}

	#-------------------------------------------------

	private function check_for_script_files()
	{
		$public_path = PUBLIC_PATH;

		$key = $this->runtime->get_current_key();
		$layouts = $this->runtime->get_layouts();

		foreach( $layouts as $layout ) 
		{
			$path = "${public_path}/runtime/${key}/${layout['layout_name']}";
			if( !directory::exists( $path ) )
			{
				directory::create( $path );
			}
		}		

		$files = $this->runtime->get_scripts();
		
		foreach( $files as $file )
		{
			$this_file = "${public_path}/runtime/${file['name']}";
			if( !file::exists($this_file) )
			{
				file::write( $this_file, $file['content'] );
			}
		}
	}

	private function do_split_test( $pages )
	{
		$page = null;

		if(count($pages) > 1)
		{
			$splits = [];

			foreach( $pages as $key => $p )
			{
				$splits[$key] = $p['percentage'];
			}

			$decision = $this->runtime->resolve_split( $splits );

			$page = $pages[$decision];
		}
		else
		{
			$page = reset($pages);
		}

		$this->page_data['PAGE']['permalink'] = $page['permalink'];
		$this->page_data['PAGE']['title'] = $page['title'];

		return $page;
	}
}
