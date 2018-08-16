<?php defined('SYSPATH') or die('No direct script access.'); ?>

2017-12-18 16:28:48 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ':' ~ MODPATH/menu/views/menu.template.php [ 23 ]
2017-12-18 16:28:48 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ':' ~ MODPATH/menu/views/menu.template.php [ 23 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2017-12-18 18:17:45 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL booth was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2017-12-18 18:17:45 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL booth was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#3 {main}