<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Jurnal extends Eloquent {

	public $table = 't_jurnal';
	public $primaryKey = 'id';
	public $timestamps = false;

}