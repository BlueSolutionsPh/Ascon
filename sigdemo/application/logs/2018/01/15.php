<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-15 16:01:15 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "rotate_flag" violates not-null constraint [ insert into 	m_movie( 		movie_id, 		image_id, 		client_id, 		movie_name, 		play_time, 		rotate_flag, 		ad_flag, 		orig_file_dir, 		file_name, 		movie_orig_file_name, 		movie_orig_file_exte, 		movie_orig_file_size, 		movie_orig_hash, 		sound_orig_file_name, 		sound_orig_file_exte, 		sound_orig_file_size, 		sound_orig_hash, 		sta_dt, 		end_dt, 		property_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		13, 		1, 		'1', 		'動画テスト2', 		NULL, 		NULL, 		'1', 		'0000000000/movie/0000000000/', 		'0000000013', 		'neconeco', 		'.mp4', 		2547842, 		'09ac65aa7261212763d4728237e9a0fb57742456d12f4e2eb0ad3dfecbd747f5', 		NULL, 		NULL, 		NULL, 		NULL, 		'2018-01-06', 		'2018-01-29', 		NULL, 		'user_1', 		'2018/01/15 16:01:15', 		'user_1', 		'2018/01/15 16:01:15' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-15 16:04:33 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "rotate_flag" violates not-null constraint [ insert into 	m_movie( 		movie_id, 		image_id, 		client_id, 		movie_name, 		play_time, 		rotate_flag, 		ad_flag, 		orig_file_dir, 		file_name, 		movie_orig_file_name, 		movie_orig_file_exte, 		movie_orig_file_size, 		movie_orig_hash, 		sound_orig_file_name, 		sound_orig_file_exte, 		sound_orig_file_size, 		sound_orig_hash, 		sta_dt, 		end_dt, 		property_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		14, 		1, 		'1', 		'動画テスト2', 		NULL, 		NULL, 		'1', 		'0000000000/movie/0000000000/', 		'0000000014', 		'neconeco', 		'.mp4', 		2547842, 		'09ac65aa7261212763d4728237e9a0fb57742456d12f4e2eb0ad3dfecbd747f5', 		NULL, 		NULL, 		NULL, 		NULL, 		'2018-01-08', 		'2018-01-29', 		NULL, 		'user_1', 		'2018/01/15 16:04:33', 		'user_1', 		'2018/01/15 16:04:33' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-15 20:23:26 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_next_id_img() ~ MODPATH/movie/classes/controller/movie.php [ 309 ]
2018-01-15 20:23:26 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_next_id_img() ~ MODPATH/movie/classes/controller/movie.php [ 309 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-15 20:29:21 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_next_id_img() ~ MODPATH/movie/classes/controller/movie.php [ 309 ]
2018-01-15 20:29:21 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_next_id_img() ~ MODPATH/movie/classes/controller/movie.php [ 309 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-15 20:30:00 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_next_id_img() ~ MODPATH/movie/classes/controller/movie.php [ 309 ]
2018-01-15 20:30:00 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_next_id_img() ~ MODPATH/movie/classes/controller/movie.php [ 309 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-15 20:31:47 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_next_id_img() ~ MODPATH/movie/classes/controller/movie.php [ 309 ]
2018-01-15 20:31:47 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_next_id_img() ~ MODPATH/movie/classes/controller/movie.php [ 309 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}