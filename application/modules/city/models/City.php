<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class City extends Eloquent {

	public $table = 'm_city';
	public $primaryKey = 'id';
	public $timestamps = false;
	
}