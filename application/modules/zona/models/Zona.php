<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Zona extends Eloquent {

	public $table = 'm_zona';
	public $primaryKey = 'id';
	public $timestamps = false;
	
}