<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Spdetail extends Eloquent {

	public $table = 't_sp_detail';
	public $primaryKey = 'id';
	public $timestamps = false;

}