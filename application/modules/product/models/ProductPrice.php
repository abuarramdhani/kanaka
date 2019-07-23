<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class ProductPrice extends Eloquent {

	public $table = 'm_product_price';
	public $primaryKey = 'id';
	public $timestamps = false;

}