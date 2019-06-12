<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Chartofaccount extends Eloquent {

	public $table = 'm_chart_of_accounts';
	public $primaryKey = 'id';
	public $timestamps = false;
	
}