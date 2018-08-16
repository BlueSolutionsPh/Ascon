<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-17 10:00:59 --- ERROR: View_Exception [ 0 ]: The requested view timezone.up_conf.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2018-01-17 10:00:59 --- STRACE: View_Exception [ 0 ]: The requested view timezone.up_conf.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /var/www/html/simplesig/modules/timezone/classes/controller/timezone.php(57): Kohana_View->set_filename('timezone.up_con...')
#1 /var/www/html/simplesig/modules/timezone/classes/controller/timezone.php(15): Controller_Timezone->disp_up()
#2 [internal function]: Controller_Timezone->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Timezone))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}
2018-01-17 15:08:16 --- ERROR: ErrorException [ 1 ]: Call to undefined method Controller_Template::get_arr_delivery_kind() ~ MODPATH/playlist/classes/controller/playlist.php [ 194 ]
2018-01-17 15:08:16 --- STRACE: ErrorException [ 1 ]: Call to undefined method Controller_Template::get_arr_delivery_kind() ~ MODPATH/playlist/classes/controller/playlist.php [ 194 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:09:30 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:09:30 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:10:26 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:10:26 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:10:28 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:10:28 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:10:29 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:10:29 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:10:31 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:10:31 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:10:33 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:10:33 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:10:35 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:10:35 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:10:36 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:10:36 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:10:37 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:10:37 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:10:40 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:10:40 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:10:44 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:10:44 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:10:50 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:10:50 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:13:14 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:13:14 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-17 15:13:19 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
2018-01-17 15:13:19 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"', expecting T_STRING or T_VARIABLE or T_NUM_STRING ~ APPPATH/classes/controller/template.php [ 1060 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}