<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public $timestamps = true;
	
    public function brand() {
		return $this->belongsTo(Brand::class, 'brand_id');
	}
}
