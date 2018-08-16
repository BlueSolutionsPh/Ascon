<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-25 10:11:09 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ')', expecting T_PAAMAYIM_NEKUDOTAYIM ~ MODPATH/commonplaylist/classes/model/commonplaylist.php [ 933 ]
2018-01-25 10:11:09 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ')', expecting T_PAAMAYIM_NEKUDOTAYIM ~ MODPATH/commonplaylist/classes/model/commonplaylist.php [ 933 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-25 10:38:31 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';', expecting ']' ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 406 ]
2018-01-25 10:38:31 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ';', expecting ']' ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 406 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-25 11:35:38 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "1_0"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '1_0' and ...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '1_0' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:35:38 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "1_1"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '1_1' and ...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '1_1' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:35:38 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "1_2"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '1_2' and ...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '1_2' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:35:38 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "1_3"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '1_3' and ...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '1_3' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:35:46 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "_4"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '_4' and  ...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '_4' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:39:01 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "25_0"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '25_0' and...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '25_0' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:39:01 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "29_1"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '29_1' and...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '29_1' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:39:06 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "30_0"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '30_0' and...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '30_0' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:39:21 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "18_0"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '18_0' and...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '18_0' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:39:28 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "19_0"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '19_0' and...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '19_0' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:39:33 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "18_0"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '18_0' and...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '18_0' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:39:33 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "21_1"
LINE 1: ..._user,  update_dt from  m_movie where  movie_id = '21_1' and...
                                                             ^ [ select 	movie_id, 	image_id, 	client_id, 	movie_name, 	play_time, 	rotate_flag, 	ad_flag, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	movie_enc_file_exte, 	movie_enc_file_size, 	movie_enc_hash, 	movie_orig_file_name, 	movie_orig_file_exte, 	movie_orig_hash, 	movie_enc_file_exte_480p, 	movie_enc_file_size_480p, 	movie_enc_hash_480p, 	movie_orig_file_name_480p, 	movie_orig_file_exte_480p, 	movie_orig_hash_480p, 	sound_enc_file_exte, 	sound_enc_file_size, 	sound_enc_hash, 	sound_orig_file_name, 	sound_orig_file_exte, 	sound_orig_hash, 	sta_dt, 	end_dt, 	property_id, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_movie where 	movie_id = '21_1' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 11:42:59 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 374 ]
2018-01-25 11:42:59 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 374 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-25 11:45:25 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 570 ]
2018-01-25 11:45:25 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 570 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-25 11:45:50 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 374 ]
2018-01-25 11:45:50 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 374 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-25 14:45:38 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "end_dt 23:59:59"
LINE 1: ...movie_rela.del_flag = 0 where  (m_movie.sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 14:45:38 --- STRACE: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "end_dt 23:59:59"
LINE 1: ...movie_rela.del_flag = 0 where  (m_movie.sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(1178): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(358): Model_Commonplaylist->sel_arr_movie_by_playlist_id_draw_area_id_dt('23', 10, 'sta_dt 00:00:00', 'end_dt 23:59:59')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(33): Controller_Commonplaylist->disp_ins()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 14:46:07 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-01-26 23:59:59 23:59:59"
LINE 1: ...d  m_client.del_flag = 0 where  m_movie.sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 14:46:07 --- STRACE: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-01-26 23:59:59 23:59:59"
LINE 1: ...d  m_client.del_flag = 0 where  m_movie.sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_movie...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(972): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(407): Model_Commonplaylist->sel_arr_movie(Object(stdClass))
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(33): Controller_Commonplaylist->disp_ins()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 14:50:50 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._id = 10 and  t_playlist_movie_rela.playlist_id = '' and  t_...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_movie.sta_dt = '2018-01-24 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_common_movie.sta_dt = '2018-01-24 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 14:50:50 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._id = 10 and  t_playlist_movie_rela.playlist_id = '' and  t_...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_movie.sta_dt = '2018-01-24 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_common_movie.sta_dt = '2018-01-24 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(1178): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(358): Model_Commonplaylist->sel_arr_movie_by_playlist_id_draw_area_id_dt('', 10, '2018-01-24 00:0...', '2018-01-26 23:5...')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(33): Controller_Commonplaylist->disp_ins()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 15:06:07 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting T_FUNCTION ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 592 ]
2018-01-25 15:06:07 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting T_FUNCTION ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 592 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-25 15:08:59 --- ERROR: View_Exception [ 0 ]: The requested view commonplaylist.up.seltmpl.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2018-01-25 15:08:59 --- STRACE: View_Exception [ 0 ]: The requested view commonplaylist.up.seltmpl.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(617): Kohana_View->set_filename('commonplaylist....')
#1 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#2 [internal function]: Controller_Commonplaylist->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}
2018-01-25 15:11:30 --- ERROR: View_Exception [ 0 ]: The requested view commonplaylist.up.seltmpl.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2018-01-25 15:11:30 --- STRACE: View_Exception [ 0 ]: The requested view commonplaylist.up.seltmpl.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(617): Kohana_View->set_filename('commonplaylist....')
#1 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#2 [internal function]: Controller_Commonplaylist->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}
2018-01-25 15:13:52 --- ERROR: View_Exception [ 0 ]: The requested view head.commonplaylist.up.seltmpl.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2018-01-25 15:13:52 --- STRACE: View_Exception [ 0 ]: The requested view head.commonplaylist.up.seltmpl.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/view.php(137): Kohana_View->set_filename('head.commonplay...')
#1 /var/www/html/simplesig/system/classes/kohana/view.php(30): Kohana_View->__construct('head.commonplay...', NULL)
#2 /var/www/html/simplesig/application/classes/controller/template.php(165): Kohana_View::factory('head.commonplay...')
#3 [internal function]: Controller_Template->after()
#4 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#5 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#8 {main}
2018-01-25 16:15:42 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 16:15:42 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(581): Model_Commonplaylist->sel_playlist('')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 16:19:36 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 16:19:36 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(581): Model_Commonplaylist->sel_playlist('')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 16:20:24 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 16:20:24 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(581): Model_Commonplaylist->sel_playlist('')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 16:22:46 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 16:22:46 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(581): Model_Commonplaylist->sel_playlist('')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 16:30:33 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 16:30:33 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(581): Model_Commonplaylist->sel_playlist('')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 16:44:09 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "playlist_id"
LINE 1: ...nts_version from  t_playlist where  playlist_id = 'playlist_...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = 'playlist_id' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 16:44:09 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "playlist_id"
LINE 1: ...nts_version from  t_playlist where  playlist_id = 'playlist_...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = 'playlist_id' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(581): Model_Commonplaylist->sel_playlist('playlist_id')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 16:44:33 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "playlist_id"
LINE 1: ...nts_version from  t_playlist where  playlist_id = 'playlist_...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = 'playlist_id' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 16:44:33 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "playlist_id"
LINE 1: ...nts_version from  t_playlist where  playlist_id = 'playlist_...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = 'playlist_id' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(581): Model_Commonplaylist->sel_playlist('playlist_id')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 16:44:48 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "playlist_id"
LINE 1: ...nts_version from  t_playlist where  playlist_id = 'playlist_...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = 'playlist_id' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 16:44:48 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "playlist_id"
LINE 1: ...nts_version from  t_playlist where  playlist_id = 'playlist_...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = 'playlist_id' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(581): Model_Commonplaylist->sel_playlist('playlist_id')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 16:45:27 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "playlist_id"
LINE 1: ...nts_version from  t_playlist where  playlist_id = 'playlist_...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = 'playlist_id' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 16:45:27 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "playlist_id"
LINE 1: ...nts_version from  t_playlist where  playlist_id = 'playlist_...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = 'playlist_id' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(581): Model_Commonplaylist->sel_playlist('playlist_id')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 16:45:46 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "プレイリストテスト0123_7"
LINE 1: ...ants_version from  t_playlist where  playlist_id = 'プレイリ...
                                                              ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = 'プレイリストテスト0123_7' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-25 16:45:46 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "プレイリストテスト0123_7"
LINE 1: ...ants_version from  t_playlist where  playlist_id = 'プレイリ...
                                                              ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = 'プレイリストテスト0123_7' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(581): Model_Commonplaylist->sel_playlist('???????????????...')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-25 19:37:23 --- ERROR: View_Exception [ 0 ]: The requested view commonplaylist.up_conf.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2018-01-25 19:37:23 --- STRACE: View_Exception [ 0 ]: The requested view commonplaylist.up_conf.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(808): Kohana_View->set_filename('commonplaylist....')
#1 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(45): Controller_Commonplaylist->disp_up()
#2 [internal function]: Controller_Commonplaylist->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}