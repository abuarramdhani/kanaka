<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Companyreportdetail extends Eloquent {

	public $table = 't_sell_in_company_detail';
	public $primaryKey = 'id';
	public $timestamps = false;
	
}