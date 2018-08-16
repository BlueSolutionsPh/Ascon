<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Error level
//error_reporting(-1);
error_reporting(0);
//error_reporting(E_ALL | E_STRICT);
//error_reporting(E_ALL & ~E_NOTICE);

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

//Constant definition
if (is_file(APPPATH.'define'.EXT)){
	require APPPATH.'define'.EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Asia/Tokyo');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');


/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
	'base_url'   => '/sigdemo/',
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'auth'       => MODPATH.'auth',       // Basic authentication
	'database'   => MODPATH.'database',   // Database access
//	'cache'      => MODPATH.'cache',      // Caching with multiple backends
//	'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	MODULE_NAME_ACCESSLOG => MODPATH . MODULE_NAME_ACCESSLOG,
	MODULE_NAME_AUTHGRP => MODPATH . MODULE_NAME_AUTHGRP,
	MODULE_NAME_BOOTH => MODPATH . MODULE_NAME_BOOTH,
	MODULE_NAME_CLIENT => MODPATH . MODULE_NAME_CLIENT,
	MODULE_NAME_COMMONIMAGE => MODPATH . MODULE_NAME_COMMONIMAGE,
	MODULE_NAME_COMMONMOVIE => MODPATH . MODULE_NAME_COMMONMOVIE,
	MODULE_NAME_COMMONTEXT => MODPATH . MODULE_NAME_COMMONTEXT,
	MODULE_NAME_CTSDL => MODPATH . MODULE_NAME_CTSDL,
	MODULE_NAME_DEV => MODPATH . MODULE_NAME_DEV,
	MODULE_NAME_DEVHTML => MODPATH . MODULE_NAME_DEVHTML,
	MODULE_NAME_DEVHTMLVIEW => MODPATH . MODULE_NAME_DEVHTMLVIEW,
	MODULE_NAME_DEVPROG => MODPATH . MODULE_NAME_DEVPROG,
	MODULE_NAME_DLLOG => MODPATH . MODULE_NAME_DLLOG,
	MODULE_NAME_HTML => MODPATH . MODULE_NAME_HTML,
	MODULE_NAME_IMAGE => MODPATH . MODULE_NAME_IMAGE,
	MODULE_NAME_LOGIN => MODPATH . MODULE_NAME_LOGIN,
	MODULE_NAME_LORDER => MODPATH . MODULE_NAME_LORDER,
	MODULE_NAME_MENU => MODPATH . MODULE_NAME_MENU,
	MODULE_NAME_MOVIE => MODPATH . MODULE_NAME_MOVIE,
	MODULE_NAME_COMMONPLAYLIST => MODPATH . MODULE_NAME_COMMONPLAYLIST,
	MODULE_NAME_PLAYLIST => MODPATH . MODULE_NAME_PLAYLIST,
	MODULE_NAME_PLAYLISTDL => MODPATH . MODULE_NAME_PLAYLISTDL,
	MODULE_NAME_PLAYLISTALL => MODPATH . MODULE_NAME_PLAYLISTALL,
	MODULE_NAME_PROG => MODPATH . MODULE_NAME_PROG,
	MODULE_NAME_PROGRGL => MODPATH . MODULE_NAME_PROGRGL,
	MODULE_NAME_PROGVIEW => MODPATH . MODULE_NAME_PROGVIEW,
	MODULE_NAME_SHOP => MODPATH . MODULE_NAME_SHOP,
	MODULE_NAME_SOLDOUT => MODPATH . MODULE_NAME_SOLDOUT,
	MODULE_NAME_TAG => MODPATH . MODULE_NAME_TAG,
	MODULE_NAME_TEXT => MODPATH . MODULE_NAME_TEXT,
	MODULE_NAME_TIMEZONE => MODPATH . MODULE_NAME_TIMEZONE,
	MODULE_NAME_USER => MODPATH . MODULE_NAME_USER,
	MODULE_NAME_MAIL => MODPATH . MODULE_NAME_MAIL,
	MODULE_NAME_PLAYCNT => MODPATH . MODULE_NAME_PLAYCNT,
	MODULE_NAME_PHPEXCEL   => MODPATH.MODULE_NAME_PHPEXCEL,
	MODULE_NAME_SOUNDALL   => MODPATH.MODULE_NAME_SOUNDALL,
	MODULE_NAME_PROPERTY => MODPATH . MODULE_NAME_PROPERTY,
//	'image'      => MODPATH.'image',      // Image manipulation
//	'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	'pagination'   => MODPATH.'pagination',   // Pagination
//	'unittest'   => MODPATH.'unittest',   // Unit testing
//	'userguide'  => MODPATH.'userguide',  // User guide and API documentation
));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

Route::set('stand_alone_bat_dl', '(<controller>(/<action>(/<playlist_id>(/<file_name>))))', array('controller' => MODULE_NAME_PLAYLISTDL, 'file_name' => STAND_ALONE_BAT_FILE_NAME))
	->defaults(array(
		'controller' => 'login',
		'action'     => 'index',
	));

Route::set('stand_alone_xml_dl', '(<controller>(/<action>(/<login_acnt>(/<passwd>(/<playlist_id>(/<file_name>))))))', array('controller' => MODULE_NAME_PLAYLISTDL, 'file_name' => STAND_ALONE_XML_FILE_NAME))
	->defaults(array(
		'controller' => 'login',
		'action'     => 'index',
	));

Route::set('stand_alone_cts_dl', '(<controller>(/<action>(/<login_acnt>(/<passwd>(/<playlist_id>(/<cts_cat>(/<file_name>.(<file_exte>))))))))', array('controller' => MODULE_NAME_PLAYLISTDL, 'file_exte' => '\w+'))
	->defaults(array(
		'controller' => 'login',
		'action'     => 'index',
	));

Route::set('cts_dl', '(<controller>(/<action>(/<cts_cat>(/<file_name>.(<file_exte>)))))', array('controller' => MODULE_NAME_CTSDL, 'file_exte' => '\w+'))
	->defaults(array(
		'controller' => 'login',
		'action'     => 'index',
	));

Route::set('accesslog', '(<controller>(/<action>(/<dev_id>(/<file_name>.html))))', array('controller' => MODULE_NAME_ACCESSLOG, 'file_name' => '[a-zA-Z0-9_./]+', 'file_exte' => '\w+'))
	->defaults(array(
		'controller' => 'login',
		'action'     => 'index',
	));

Route::set('default', '(<controller>(/<action>(/<param1>(/<param2>(/<param3>)))))')
	->defaults(array(
		'controller' => 'login',
		'action'     => 'index',
	));

