<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Category');
    }
}
