<?php

namespace App\Http\Controllers\Pub;

use App\Models\Pub\Page;
use App\Models\Pub\Post;
use App\Models\Pub\Event;
use Response;
use Request;
use View;

class PageController extends BaseController {

	public function index() {

		$data = [];

		$page = Page::where('permalink', '=', Request::path());

		if ($page->count()) {
			$data['page'] = $page->first();
			$data['page']->content = $this->replaceModule($data['page']->content);

			return $this->checkIfPublished($data['page'], View::make($this->getTemplate(), $data));

		} else {
			return Response::view('pub/pages/404', array('reponse' => 404), 404);
		}
	}

}
