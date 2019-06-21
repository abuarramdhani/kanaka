<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class District extends Eloquent {

	public $table = 'm_district';
	public $primaryKey = 'id';
	public $timestamps = false;
	
}