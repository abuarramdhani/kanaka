<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class ProductImage extends Eloquent {

	public $table = 'm_product_image';
	public $primaryKey = 'id';
	public $timestamps = false;

}