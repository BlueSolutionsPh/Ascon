<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-02-22 19:36:46 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "movie_id" violates not-null constraint [ insert into 	t_playlist_movie_rela( 		playlist_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		300,		NULL,		10,		'1',		1,		'user_1',		'2018/02/22 19:36:46',		'user_1',		'2018/02/22 19:36:46'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-22 19:36:46 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_movie_rela( 		playlist_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		301,		NULL,		10,		'1',		1,		'user_1',		'2018/02/22 19:36:46',		'user_1',		'2018/02/22 19:36:46'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-22 19:36:46 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_movie_rela( 		playlist_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		302,		NULL,		10,		'1',		2,		'user_1',		'2018/02/22 19:36:46',		'user_1',		'2018/02/22 19:36:46'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-22 19:36:46 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		56, 		50, 		126, 		'1', 		1, 		2, 		1, 		'2018-02-01 00:00:00', 		'2018-02-28 00:00:00', 		'user_1', 		'2018/02/22 19:36:46', 		'user_1', 		'2018/02/22 19:36:46' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-22 19:36:46 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		57, 		3, 		126, 		'1', 		0, 		3, 		1, 		'2018-02-01 00:00:00', 		'2018-02-28 00:00:00', 		'user_1', 		'2018/02/22 19:36:46', 		'user_1', 		'2018/02/22 19:36:46' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-22 19:36:46 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		58, 		15, 		126, 		'1', 		0, 		2, 		1, 		'2018-02-01 00:00:00', 		'2018-02-28 00:00:00', 		'user_1', 		'2018/02/22 19:36:46', 		'user_1', 		'2018/02/22 19:36:46' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]