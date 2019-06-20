<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Code extends Eloquent {

	public $table = 'm_code';
	public $primaryKey = 'id';
	public $timestamps = false;
	
}