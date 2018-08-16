<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-02-07 17:59:58 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_M_Shop::ups() ~ MODPATH/shop/classes/model/shop.php [ 581 ]
2018-02-07 17:59:58 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_M_Shop::ups() ~ MODPATH/shop/classes/model/shop.php [ 581 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-07 18:01:02 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_M_Shop::ups() ~ MODPATH/shop/classes/model/shop.php [ 581 ]
2018-02-07 18:01:02 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_M_Shop::ups() ~ MODPATH/shop/classes/model/shop.php [ 581 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-07 18:01:41 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000005" requires 1 [ update 	m_shop set 	shop_name = 'テスト店舗_0207_1', 	post = '218872', 	address = '53 Owen Road, 53 Owen Road, (S)218872', 	lat = 1.313011, 	lon = 103.853570, 	update_user = 'user_1', 	update_dt = '2018/02/07 18:01:41' where 	shop_id = :shop_id and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-07 18:01:49 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000005" requires 1 [ update 	m_shop set 	shop_name = 'テスト店舗_0207_1', 	post = '218872', 	address = '53 Owen Road, 53 Owen Road, (S)218872', 	lat = 1.313011, 	lon = 103.853570, 	update_user = 'user_1', 	update_dt = '2018/02/07 18:01:49' where 	shop_id = :shop_id and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-07 18:06:22 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000005" requires 1 [ update 	m_shop set 	shop_name = :shop_name, 	post = '208854', 	address = '136 Jalan Besar, 136 Jalan Besar, (S)208854', 	lat = 1.313011, 	lon = 103.853570, 	update_user = 'user_1', 	update_dt = '2018/02/07 18:06:22' where 	shop_id = '2' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-07 19:10:39 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '=' ~ MODPATH/shop/classes/controller/shop.php [ 228 ]
2018-02-07 19:10:39 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '=' ~ MODPATH/shop/classes/controller/shop.php [ 228 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-07 19:41:29 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for type double precision: ""
LINE 1: ... '136 Jalan Besar, 136 Jalan Besar, (S)208854',   '',   '', ...
                                                             ^ [ insert into 	m_shop( 		shop_id, 		client_id, 		shop_name, 	    sta_t, 	    end_t, 		note, 		post, 		address, 		lat, 		lon, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		18, 		'1', 		'テスト店舗_0207_5', 		0, 		0, 		NULL, 		'208854', 		'136 Jalan Besar, 136 Jalan Besar, (S)208854', 		'', 		'', 		'user_1', 		'2018/02/07 19:41:29', 		'user_1', 		'2018/02/07 19:41:29' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]