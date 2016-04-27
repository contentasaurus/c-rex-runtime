<?php

  namespace App\Models\Pub;

  class User extends \Moloquent
  {

      protected $collection = 'users';
      protected $hidden = ['password', 'remember_token'];

      public function page() {
        return $this->hasMany('Page', 'author', '_id');
      }

  }
