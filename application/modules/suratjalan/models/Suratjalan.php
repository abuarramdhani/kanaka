<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Suratjalan extends Eloquent {

	public $table = 't_sj';
	public $primaryKey = 'id';
	public $timestamps = false;

}