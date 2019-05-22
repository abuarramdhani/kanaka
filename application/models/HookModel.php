<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Author Message
|--------------------------------------------------------------------------
|
| Fetch the config variables from DB
| 
*/
class HookModel extends CI_Model {

    public function __construct()
    {
	    parent::__construct();
    }

    public function get_config()
    {
	    return $this->db->get('configurations');
    }

	public function get_company()
    {
	    return $this->db->get('company');
    }
	
}