<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Db_Ins extends stdClass
{
	public $create_user;
	public $create_dt;
	public $update_user;
	public $update_dt;
	
	public function __construct()
	{
		$this->create_user = Session::get_login_db_user();
		$this->create_dt = Request::$request_dt;
		$this->update_user = Session::get_login_db_user();
		$this->update_dt = Request::$request_dt;
	}
}