<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Partner extends Eloquent {

	public $table = 'm_dipo_partner';
	public $primaryKey = 'id';
	public $timestamps = false;

}