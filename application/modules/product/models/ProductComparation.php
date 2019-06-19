<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class ProductComparation extends Eloquent {

	public $table = 'm_product_comparation';
	public $primaryKey = 'id';
	public $timestamps = false;

}