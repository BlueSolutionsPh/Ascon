<?php defined('SYSPATH') or die('No direct script access.'); ?>

2016-11-18 16:03:08 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "random_flag" violates not-null constraint [ insert into 	t_playlist( 		playlist_id, 		draw_tmpl_id, 		client_id, 		playlist_name, 		playlist_desc, 		image_intvl, 		random_flag, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		12, 		'5', 		1, 		'amatest01', 		NULL, 		'4', 		NULL, 		'user_1', 		'2016/11/18 16:03:07', 		'user_1', 		'2016/11/18 16:03:07' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2016-11-18 16:03:08 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_movie_rela( 		playlist_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		12,		'11',		10,		1,		0,		'user_1',		'2016/11/18 16:03:07',		'user_1',		'2016/11/18 16:03:07'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2016-11-18 16:44:58 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "random_flag" violates not-null constraint [ insert into 	t_playlist( 		playlist_id, 		draw_tmpl_id, 		client_id, 		playlist_name, 		playlist_desc, 		image_intvl, 		random_flag, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		13, 		'5', 		1, 		'amatest01', 		NULL, 		'4', 		NULL, 		'user_1', 		'2016/11/18 16:44:58', 		'user_1', 		'2016/11/18 16:44:58' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2016-11-18 16:44:58 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_movie_rela( 		playlist_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		13,		'11',		10,		1,		0,		'user_1',		'2016/11/18 16:44:58',		'user_1',		'2016/11/18 16:44:58'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]