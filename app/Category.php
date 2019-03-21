<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   public function category_products()
   {
	  return $this->belongsToMany('App\Products');
   }
}
