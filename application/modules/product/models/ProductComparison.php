<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class ProductComparison extends Eloquent {

	public $table = 'm_product_comparison';
	public $primaryKey = 'id';
	public $timestamps = false;

}