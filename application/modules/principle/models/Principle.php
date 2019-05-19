<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Principle extends Eloquent {

	public $table = 'm_principle';
	public $primaryKey = 'id';
	public $timestamps = false;

}