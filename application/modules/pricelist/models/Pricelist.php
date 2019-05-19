<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Pricelist extends Eloquent {

	public $table = 't_pricelist';
	public $primaryKey = 'id';
	public $timestamps = false;

}