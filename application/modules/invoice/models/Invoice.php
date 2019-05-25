<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Invoice extends Eloquent {

	public $table = 't_invoice';
	public $primaryKey = 'id';
	public $timestamps = false;
	
}