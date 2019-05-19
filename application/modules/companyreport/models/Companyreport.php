<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Companyreport extends Eloquent {

	public $table = 't_company';
	public $primaryKey = 'id';
	public $timestamps = false;
	
}