<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Returdetail extends Eloquent {

	public $table = 't_sell_out_company_detail';
	public $primaryKey = 'id';
	public $timestamps = false;
	
}