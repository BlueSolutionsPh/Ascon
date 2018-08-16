<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-03-12 18:39:10 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "sta_time" violates not-null constraint [ insert into 	t_prog_rgl( 		prog_id, 		prog_rgl_grp_id, 		client_id, 		sta_time, 		end_time, 		year, 		month, 		day, 		mon, 		tues, 		wednes, 		thurs, 		fri, 		satur, 		sun, 		priority, 		col_id, 		row_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		800, 		726, 		'7', 		NULL, 		NULL, 		0, 		0, 		0, 		1, 		1, 		1, 		1, 		1, 		1, 		1, 		1, 		0, 		2, 		'user_1', 		'2018/03/12 18:39:10', 		'user_1', 		'2018/03/12 18:39:10' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-12 18:44:52 --- ERROR: ErrorException [ 1 ]: Call to undefined function str() ~ MODPATH/playlist/classes/controller/playlist.php [ 503 ]
2018-03-12 18:44:52 --- STRACE: ErrorException [ 1 ]: Call to undefined function str() ~ MODPATH/playlist/classes/controller/playlist.php [ 503 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-03-12 18:55:04 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-04-30 23:59:59 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-12 18:55:04 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-04-30 23:59:59 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]