<?php
namespace App\Http\Controllers\Pub;

use App\Models\Pub\Post;
use App\Models\Pub\Page;
use App\Models\Pub\Event;
use View;

class HomeController extends BaseController
{
	public function index() {

		$recent_developments = $this->recent_developments();

		return View::make('pub/pages/home', [
			'recent_developments' => $recent_developments,
			'page' => [
				'permalink' => '/'
			]
		]);
	}

	private function recent_developments() {
		$case_studies = array_map( function($case_study){
			if( isset( $case_study['categories'] ) ){
				$case_study['pretty_categories'] = join(' &amp; ', $case_study['categories'] );
			}
			return $case_study;
		}, Page::where('type', '=', 'case_study')->orderBy('published_at','DESC')->limit(4)->get()->toArray() );
		$articles = Post::orderBy('published_at','DESC')->limit(4)->get()->toArray();
		$combined = [];
		for( $i = 0; $i < 4; $i++ ) {
			if( isset($case_studies[$i]) ){
				$case_study = $case_studies[$i];
				$case_study['superscript'] = 'Case Studies: ';
			  array_push($combined, $case_study);
		  }
			if( isset($articles[$i]) ){
				$article = $articles[$i];
				$article['superscript'] = $article['published_at']->toDateTime()->format('F j, Y');
				array_push($combined, $article);
		  }
		}
		return $combined;
	}

}
