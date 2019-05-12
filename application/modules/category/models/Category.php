<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent {

	public $table = 'm_category';
	public $primaryKey = 'id';
	public $timestamps = false;

}