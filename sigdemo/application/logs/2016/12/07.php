<?php defined('SYSPATH') or die('No direct script access.'); ?>

2016-12-07 16:08:50 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL kohana was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2016-12-07 16:08:50 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL kohana was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/html/ants2/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/html/ants2/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/html/ants2/index.php(109): Kohana_Request->execute()
#3 {main}