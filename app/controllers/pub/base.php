<?php

  namespace App\Http\Controllers\Pub;

  use App\Models\Admin\User;
  use Response;
  use Request;
  use View;

  class BaseController extends \App\Http\Controllers\Controller {

    protected function getTemplate() {
  		// Overrides default template with a custom template
  		$template_name = strtolower(preg_replace(['/[^A-Za-z0-9\- ]/', '/[^A-Za-z0-9\-]/', '/-+/'], [' ', '_', '_'], rtrim(Request::path())));

  		if (View::exists('pub.templates.'.$template_name)) {
  			return 'pub/templates/'.$template_name;
  		}

  		return 'pub/pages/page';
  	}

    protected function replaceModule($content) {

  		// Strip <p> tags of the front and end of module string. Module example [%moduleName%]
  		$content = preg_replace('%(?:<p>)?(\[\%.*\%\])(?:</p>)?%', '$1', $content);

  		// Replaces module tags [%collapsible%][%/collapsible%], [%title%][%/title%]
  		// [%content%][%/content%] with HTML for collapsible content
  		$content = preg_replace(
  			array(
  				'%.*(\[\%collapsible\%\]).*%',
  				'%.*(\[\%\/collapsible\%\]).*%',
  				'%(.*)\[\%title\%\](.*)\[\%\/title\%\](.*)%',
  				'%.*(\[\%content\%\]).*%',
  				'%.*(\[\%\/content\%\]).*%'),
  			array(
  				'<div class="collapsible">',
  				'</div>',
  				'<div class="collapsible-title">$1$2$3</div>',
  				'<div class="collapsible-content">',
  				'</div>'),
  			$content);

  		return preg_replace_callback('%\[\%(.*)\%\]%',function ($module) {
  		    return View::exists('pub/modules/'.$module[1]) ? View::make('pub/modules/'.$module[1]) : '';
  		}, $content);
  	}

    protected function checkIfPublished($object, $view) {

      if (!isset($object->published_at) && \Auth::check()) {
        return $view;
      }

      if (!isset($object->published_at)) {
        return Response::view('pub/pages/404', array('reponse' => 404), 404);
      }

      return $view;

    }

  }
