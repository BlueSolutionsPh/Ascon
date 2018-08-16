<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-03-22 14:34:29 --- ERROR: ReflectionException [ 0 ]: Function post() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
2018-03-22 14:34:29 --- STRACE: ReflectionException [ 0 ]: Function post() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/validation.php(383): ReflectionFunction->__construct('post')
#1 /var/www/html/simplesig/modules/shop/classes/controller/shop.php(178): Kohana_Validation->check()
#2 /var/www/html/simplesig/modules/shop/classes/controller/shop.php(112): Controller_Shop->ins_validation()
#3 /var/www/html/simplesig/modules/shop/classes/controller/shop.php(15): Controller_Shop->disp_ins()
#4 [internal function]: Controller_Shop->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Shop))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-03-22 17:05:16 --- ERROR: ReflectionException [ 0 ]: Function wifipass() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
2018-03-22 17:05:16 --- STRACE: ReflectionException [ 0 ]: Function wifipass() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/validation.php(383): ReflectionFunction->__construct('wifipass')
#1 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(154): Kohana_Validation->check()
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(101): Controller_Booth->ins_validation()
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(15): Controller_Booth->disp_ins()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-03-22 17:08:37 --- ERROR: ReflectionException [ 0 ]: Function wifipass() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
2018-03-22 17:08:37 --- STRACE: ReflectionException [ 0 ]: Function wifipass() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/validation.php(383): ReflectionFunction->__construct('wifipass')
#1 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(154): Kohana_Validation->check()
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(101): Controller_Booth->ins_validation()
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(15): Controller_Booth->disp_ins()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-03-22 17:09:47 --- ERROR: ReflectionException [ 0 ]: Function wifipass() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
2018-03-22 17:09:47 --- STRACE: ReflectionException [ 0 ]: Function wifipass() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/validation.php(383): ReflectionFunction->__construct('wifipass')
#1 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(154): Kohana_Validation->check()
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(101): Controller_Booth->ins_validation()
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(15): Controller_Booth->disp_ins()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}