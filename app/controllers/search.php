<?php

  namespace App\Http\Controllers\Pub;

  use App\Models\Pub\Page;
  use App\Models\Pub\Post;

  class SearchController extends BaseController {

      public function index()
      {
          return \View::make('pub.pages.search-results', ['searchResults' => $this->search(\Input::get('keyword'))]);
      }

      private function search($keyword)
      {
          //Pages: content
          $pageArr = Page::whereNotNull('published_at')->where('title', 'like', '%' . $keyword . '%')
              ->orWhere('content', 'like', '%' . $keyword . '%')
              ->get(['title', 'type', 'content', 'permalink'])->toArray();

          //Posts: title, content
          $postArr = Post::whereNotNull('published_at')->where('title', 'like', '%' . $keyword . '%')
              ->orWhere('content', 'like', '%' . $keyword . '%')
              ->get(['title', 'content', 'permalink'])->toArray();

          return array_merge($pageArr, $postArr );

      }
  }
