<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Companyreportout extends Eloquent {

	public $table = 't_sell_out_company';
	public $primaryKey = 'id';
	public $timestamps = false;
	
}