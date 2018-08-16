<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Db_Up extends stdClass
{
	public $update_user;
	public $update_dt;
	
	public function __construct()
	{
		$this->update_user = Session::get_login_db_user();
		$this->update_dt = Request::$request_dt;
	}
}