<?php if (!defined('SYSPATH')) exit('No direct script access');

class Model_M_Auth extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db)
	{
		$this->db = $db;
	}
}