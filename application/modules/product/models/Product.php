<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Product extends Eloquent {

	public $table = 'm_product';
	public $primaryKey = 'id';
	public $timestamps = false;

}