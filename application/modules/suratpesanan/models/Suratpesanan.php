<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Suratpesanan extends Eloquent {

	public $table = 't_sp';
	public $primaryKey = 'id';
	public $timestamps = false;

}