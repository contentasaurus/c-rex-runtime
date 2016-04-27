<?php
namespace App\Http\Controllers\Pub;

use URL;
use View;
use Sitemap;
use Request;
use DateTime;
use App\Models\Pub\Page;
use App\Models\Pub\Post;
use App\Models\Pub\Event;

class SitemapController extends BaseController {
    private $data = [];

    public function index(){
        $this->get_data();
        return View::make('pub.pages.sitemap', $this->data);
    }

    public function xml(){
        Sitemap::addTag(route('index'), '2015-12-23T17:21:59+00:00', 'daily', 1);
        Sitemap::addTag(route('events'), '2015-12-23T17:21:59+00:00', 'daily', 0.5);

        $this->get_data();

        foreach ($this->data as $key => $value) {
            if($key == 'pages'){
                $this->add_items($value, 1);
            }
            $this->add_items($value);
        }

        return Sitemap::render();
    }

    private function get_data(){
        $this->data['projects'] = Page::whereNotNull('published_at')
            ->where('type', '=', 'project')
            ->orderBy('sort_order', 'ASC')
            ->orderBy('title', 'ASC')
            ->get()
            ->toArray();

        $this->data['employees'] = Page::whereNotNull('published_at')
            ->where('type', '=', 'employee')
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'ASC')
            ->get()
            ->toArray();

        $this->data['articles'] = Post::whereNotNull('published_at')
            ->orderBy('published_at','DESC')
            ->get()
            ->toArray();

        $this->data['case_studies'] = Page::whereNotNull('published_at')
            ->where('type', '=', 'case_study')
            ->orderBy('sort_order','ASC')
            ->get()
            ->toArray();

        $this->data['pages'] = Page::where('type', '=', 'page')
            ->get()
            ->toArray();

        $this->data['events'] = Event::whereNotNull('published_at')
            ->get()
            ->toArray();
    }

    private function add_items($results, $weight = 0.5){
        foreach ($results as $key => $result) {
            Sitemap::addTag(
                route('index') . '/' . $result['permalink'],
                $result['published_at']->toDateTime()->format('Y-m-d H:i:s'),
                'daily',
                $weight
            );
        }
    }
}
