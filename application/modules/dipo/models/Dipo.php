<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Dipo extends Eloquent {

	public $table = 'm_dipo';
	public $primaryKey = 'id';
	public $timestamps = false;

}