<?php

	namespace App\Http\Controllers\Pub;

	use App\Models\Pub\Page;
	use App\Models\Pub\Post;
	use Response;
  use Request;
  use View;

	class PostController extends BaseController
	{

		public function index()
		{
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

		public function article() {

			$data = [];

			$post = Post::with('user')->where('permalink', '=', Request::path());

			if ($post->count()) {
				$data['article'] = $post->first();

				if (isset($data['article']->published_at)) {
					$previous = Post::with('user')->where('published_at', '<', $data['article']->published_at)->orderBy('published_at', 'DESC');

					if ($previous->count()) {
						$data['previous_article'] = $previous->first();
					} else {
						$data['previous_article'] = Post::with('user')->orderBy('published_at', 'DESC')->first();
					}
				}

				$data['article']->content = $this->replaceModule($data['article']->content);

				return $this->checkIfPublished($data['article'], View::make('pub.templates.article', $data));

			} else {
				return Response::view('pub/pages/404', array('reponse' => 404), 404);
			}
		}

	}
