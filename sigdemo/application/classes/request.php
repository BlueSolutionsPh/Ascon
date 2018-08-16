<?php defined('SYSPATH') or die('No direct script access.');

class Request extends Kohana_Request {
	public static $request_dt;
	public static $token;
	
	public static function factory($uri = TRUE, HTTP_Cache $cache = NULL, $injected_routes = array())
	{
		Request::$request_dt = date("Y/m/d H:i:s");
		Request::$token = Security::token(true);
		return Kohana_Request::factory($uri, $cache, $injected_routes);
	}
}