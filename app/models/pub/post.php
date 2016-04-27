<?php

	namespace App\Models\Pub;

	class Post extends \Moloquent {

		protected $collection = 'posts';

		public function user() {
			return $this->belongsTo('App\Models\Pub\User', 'author');
		}

	}
