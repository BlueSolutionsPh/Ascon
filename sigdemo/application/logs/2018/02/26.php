<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-02-26 10:31:22 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist.del__flag does not exist
LINE 1: ..._flag = 0 where  t_playlist.timezone_id  1 and  t_playlist...
                                                             ^ [ select 	t_playlist.playlist_id, 	t_playlist.draw_tmpl_id, 	t_playlist.playlist_name, 	t_playlist.ants_version, 	t_playlist.sex_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, 	m_draw_tmpl.draw_tmpl_name, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				exists ( 					select 						t_prog_inner.prog_id 					from 						t_prog t_prog_inner 					where 						t_prog_outer.prog_id = t_prog_inner.prog_id and 						t_prog_outer.dev_id = t_prog_inner.dev_id and 						t_prog_inner.sta_dt  '2018/02/26 10:31:22' or t_prog_inner.end_dt is null) and 						t_prog_inner.del_flag = 0 				) and 				(t_prog_outer.end_dt > '2018/02/26 10:31:22' or t_prog_outer.end_dt is null) and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_now, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				t_prog_outer.sta_dt > '2018/02/26 10:31:22' and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_future, 	( 		select 			count(t_prog_rgl.prog_id) 		from 			t_prog_rgl_grp 		join 			t_prog_rgl 		on 			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 			t_prog_rgl.del_flag = 0 		join 			t_prog_playlist_rela 		on 			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 		where 			t_prog_rgl_grp.del_flag = 0 	) as prog_cnt_rgl, 	m_client.client_id, 	m_client.client_name, 	m_timezone.timezone_id, 	m_timezone.timezone_name from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_client on 	t_playlist.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_timezone on 	t_playlist.timezone_id = m_timezone.timezone_id and 	m_timezone.del_flag = 0 where 	t_playlist.timezone_id  1 and 	t_playlist.del__flag = 0 order by 	convert_to(t_playlist.playlist_name,'UTF8'), 	t_playlist.playlist_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 10:31:22 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist.del__flag does not exist
LINE 1: ..._flag = 0 where  t_playlist.timezone_id  1 and  t_playlist...
                                                             ^ [ select 	t_playlist.playlist_id, 	t_playlist.draw_tmpl_id, 	t_playlist.playlist_name, 	t_playlist.ants_version, 	t_playlist.sex_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, 	m_draw_tmpl.draw_tmpl_name, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				exists ( 					select 						t_prog_inner.prog_id 					from 						t_prog t_prog_inner 					where 						t_prog_outer.prog_id = t_prog_inner.prog_id and 						t_prog_outer.dev_id = t_prog_inner.dev_id and 						t_prog_inner.sta_dt  '2018/02/26 10:31:22' or t_prog_inner.end_dt is null) and 						t_prog_inner.del_flag = 0 				) and 				(t_prog_outer.end_dt > '2018/02/26 10:31:22' or t_prog_outer.end_dt is null) and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_now, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				t_prog_outer.sta_dt > '2018/02/26 10:31:22' and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_future, 	( 		select 			count(t_prog_rgl.prog_id) 		from 			t_prog_rgl_grp 		join 			t_prog_rgl 		on 			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 			t_prog_rgl.del_flag = 0 		join 			t_prog_playlist_rela 		on 			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 		where 			t_prog_rgl_grp.del_flag = 0 	) as prog_cnt_rgl, 	m_client.client_id, 	m_client.client_name, 	m_timezone.timezone_id, 	m_timezone.timezone_name from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_client on 	t_playlist.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_timezone on 	t_playlist.timezone_id = m_timezone.timezone_id and 	m_timezone.del_flag = 0 where 	t_playlist.timezone_id  1 and 	t_playlist.del__flag = 0 order by 	convert_to(t_playlist.playlist_name,'UTF8'), 	t_playlist.playlist_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_playl...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(908): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(845): Model_Playlist->sel_arr_playlist_neco(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(758): Controller_Playlist->ins_playlist_rera(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(310): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-26 10:39:11 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist.del__flag does not exist
LINE 1: ..._flag = 0 where  t_playlist.timezone_id  1 and  t_playlist...
                                                             ^ [ select 	t_playlist.playlist_id, 	t_playlist.draw_tmpl_id, 	t_playlist.playlist_name, 	t_playlist.ants_version, 	t_playlist.sex_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, 	m_draw_tmpl.draw_tmpl_name, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				exists ( 					select 						t_prog_inner.prog_id 					from 						t_prog t_prog_inner 					where 						t_prog_outer.prog_id = t_prog_inner.prog_id and 						t_prog_outer.dev_id = t_prog_inner.dev_id and 						t_prog_inner.sta_dt  '2018/02/26 10:39:11' or t_prog_inner.end_dt is null) and 						t_prog_inner.del_flag = 0 				) and 				(t_prog_outer.end_dt > '2018/02/26 10:39:11' or t_prog_outer.end_dt is null) and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_now, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				t_prog_outer.sta_dt > '2018/02/26 10:39:11' and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_future, 	( 		select 			count(t_prog_rgl.prog_id) 		from 			t_prog_rgl_grp 		join 			t_prog_rgl 		on 			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 			t_prog_rgl.del_flag = 0 		join 			t_prog_playlist_rela 		on 			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 		where 			t_prog_rgl_grp.del_flag = 0 	) as prog_cnt_rgl, 	m_timezone.timezone_id, 	m_timezone.timezone_name from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_timezone on 	t_playlist.timezone_id = m_timezone.timezone_id and 	m_timezone.del_flag = 0 where 	t_playlist.timezone_id  1 and 	t_playlist.del__flag = 0 order by 	convert_to(t_playlist.playlist_name,'UTF8'), 	t_playlist.playlist_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 10:39:11 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist.del__flag does not exist
LINE 1: ..._flag = 0 where  t_playlist.timezone_id  1 and  t_playlist...
                                                             ^ [ select 	t_playlist.playlist_id, 	t_playlist.draw_tmpl_id, 	t_playlist.playlist_name, 	t_playlist.ants_version, 	t_playlist.sex_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, 	m_draw_tmpl.draw_tmpl_name, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				exists ( 					select 						t_prog_inner.prog_id 					from 						t_prog t_prog_inner 					where 						t_prog_outer.prog_id = t_prog_inner.prog_id and 						t_prog_outer.dev_id = t_prog_inner.dev_id and 						t_prog_inner.sta_dt  '2018/02/26 10:39:11' or t_prog_inner.end_dt is null) and 						t_prog_inner.del_flag = 0 				) and 				(t_prog_outer.end_dt > '2018/02/26 10:39:11' or t_prog_outer.end_dt is null) and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_now, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				t_prog_outer.sta_dt > '2018/02/26 10:39:11' and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_future, 	( 		select 			count(t_prog_rgl.prog_id) 		from 			t_prog_rgl_grp 		join 			t_prog_rgl 		on 			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 			t_prog_rgl.del_flag = 0 		join 			t_prog_playlist_rela 		on 			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 		where 			t_prog_rgl_grp.del_flag = 0 	) as prog_cnt_rgl, 	m_timezone.timezone_id, 	m_timezone.timezone_name from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_timezone on 	t_playlist.timezone_id = m_timezone.timezone_id and 	m_timezone.del_flag = 0 where 	t_playlist.timezone_id  1 and 	t_playlist.del__flag = 0 order by 	convert_to(t_playlist.playlist_name,'UTF8'), 	t_playlist.playlist_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_playl...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(887): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(845): Model_Playlist->sel_arr_playlist_neco(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(758): Controller_Playlist->ins_playlist_rera(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(310): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-26 14:00:01 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:00:01 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:00:01 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:00:01 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:00:01 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:00:01 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:00:26 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:00:26 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:00:26 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:00:26 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:00:26 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:00:26 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:08:24 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:08:24 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:08:24 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:08:24 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:08:24 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:08:24 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ...ela.playlist_rela_id from  t_playlist_rela where  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:11:40 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ..._id = 4 and  t_playlist_rela.client_id = '2' and  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.common_playlist_id = 166 and 	t_playlist_rela.sex_id = 1 and 	t_playlist_rela.timezone_id = 4 and 	t_playlist_rela.client_id = '2' and 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:11:40 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ..._id = 3 and  t_playlist_rela.client_id = '2' and  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.common_playlist_id = 167 and 	t_playlist_rela.sex_id = 1 and 	t_playlist_rela.timezone_id = 3 and 	t_playlist_rela.client_id = '2' and 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:11:40 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ..._id = 2 and  t_playlist_rela.client_id = '2' and  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.common_playlist_id = 168 and 	t_playlist_rela.sex_id = 1 and 	t_playlist_rela.timezone_id = 2 and 	t_playlist_rela.client_id = '2' and 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:11:40 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ..._id = 4 and  t_playlist_rela.client_id = '2' and  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.common_playlist_id = 171 and 	t_playlist_rela.sex_id = 0 and 	t_playlist_rela.timezone_id = 4 and 	t_playlist_rela.client_id = '2' and 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:11:40 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ..._id = 3 and  t_playlist_rela.client_id = '2' and  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.common_playlist_id = 170 and 	t_playlist_rela.sex_id = 0 and 	t_playlist_rela.timezone_id = 3 and 	t_playlist_rela.client_id = '2' and 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:11:40 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ..._id = 2 and  t_playlist_rela.client_id = '2' and  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.common_playlist_id = 169 and 	t_playlist_rela.sex_id = 0 and 	t_playlist_rela.timezone_id = 2 and 	t_playlist_rela.client_id = '2' and 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:18:19 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ..._id = 4 and  t_playlist_rela.client_id = '2' and  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.common_playlist_id = 166 and 	t_playlist_rela.sex_id = 1 and 	t_playlist_rela.timezone_id = 4 and 	t_playlist_rela.client_id = '2' and 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:18:19 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select nextval(pg_catalog.pg_get_serial_sequence('t_playlist_rela', 'playlist_rela___id')) ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:18:19 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 166 and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:18:19 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 166 and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2714): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(873): Model_Playlist->sel_arr_id_name_playlist_movie_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(758): Controller_Playlist->ins_playlist_rera(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(310): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-26 14:23:56 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ..._id = 4 and  t_playlist_rela.client_id = '2' and  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.common_playlist_id = 166 and 	t_playlist_rela.sex_id = 1 and 	t_playlist_rela.timezone_id = 4 and 	t_playlist_rela.client_id = '2' and 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:23:56 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select nextval(pg_catalog.pg_get_serial_sequence('t_playlist_rela', 'playlist_rela___id')) ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:23:56 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 166 and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:23:56 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 166 and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2715): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(873): Model_Playlist->sel_arr_id_name_playlist_movie_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(758): Controller_Playlist->ins_playlist_rera(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(310): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-26 14:25:34 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ..._id = 4 and  t_playlist_rela.client_id = '2' and  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.common_playlist_id = 166 and 	t_playlist_rela.sex_id = 1 and 	t_playlist_rela.timezone_id = 4 and 	t_playlist_rela.client_id = '2' and 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 14:25:34 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_rela.del__flag does not exist
LINE 1: ..._id = 4 and  t_playlist_rela.client_id = '2' and  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_rela_id) as cnt from ( select 	t_playlist_rela.playlist_rela_id from 	t_playlist_rela where 	t_playlist_rela.common_playlist_id = 166 and 	t_playlist_rela.sex_id = 1 and 	t_playlist_rela.timezone_id = 4 and 	t_playlist_rela.client_id = '2' and 	t_playlist_rela.del__flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(p...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2830): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(852): Model_Playlist->sel_cnt_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(758): Controller_Playlist->ins_playlist_rera(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(310): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-26 15:06:13 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ')', expecting T_PAAMAYIM_NEKUDOTAYIM ~ MODPATH/playlist/classes/model/playlist.php [ 2831 ]
2018-02-26 15:06:13 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ')', expecting T_PAAMAYIM_NEKUDOTAYIM ~ MODPATH/playlist/classes/model/playlist.php [ 2831 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-26 15:07:06 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "from"
LINE 1: ...timezone_id,  deliverymonth_id,  sta_dt,  end_dt, from  t_pl...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 1 and 	timezone_id = 4 and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 15:07:06 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "from"
LINE 1: ...timezone_id,  deliverymonth_id,  sta_dt,  end_dt, from  t_pl...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 1 and 	timezone_id = 4 and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2845): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(852): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(758): Controller_Playlist->ins_playlist_rera(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(310): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-26 16:07:32 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/playlist/classes/model/playlist.php [ 2787 ]
2018-02-26 16:07:32 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/playlist/classes/model/playlist.php [ 2787 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-26 16:07:39 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/playlist/classes/model/playlist.php [ 2787 ]
2018-02-26 16:07:39 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/playlist/classes/model/playlist.php [ 2787 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-26 16:07:40 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/playlist/classes/model/playlist.php [ 2787 ]
2018-02-26 16:07:40 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/playlist/classes/model/playlist.php [ 2787 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-26 16:07:53 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/playlist/classes/model/playlist.php [ 2787 ]
2018-02-26 16:07:53 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/playlist/classes/model/playlist.php [ 2787 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-26 16:08:10 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/playlist/classes/model/playlist.php [ 2787 ]
2018-02-26 16:08:10 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/playlist/classes/model/playlist.php [ 2787 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-26 16:12:57 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "prog_name" violates not-null constraint [ insert into 	t_prog_rgl_grp( 		prog_rgl_grp_id, 		dev_id, 		client_id, 		prog_name, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		204, 		1, 		'1', 		NULL, 		'user_1', 		'2018/02/26 16:12:57', 		'user_1', 		'2018/02/26 16:12:57' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 16:20:22 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "prog_name" violates not-null constraint [ insert into 	t_prog_rgl_grp( 		prog_rgl_grp_id, 		dev_id, 		client_id, 		prog_name, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		205, 		21, 		'2', 		NULL, 		'user_1', 		'2018/02/26 16:20:22', 		'user_1', 		'2018/02/26 16:20:22' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 17:17:56 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_movie.del__flag does not exist
LINE 1: ...8-02-01 00:00:00' or m_movie.end_dt is null) and  m_movie.de...
                                                             ^ [ select 	m_movie.movie_id, 	m_movie.image_id, 	m_movie.movie_name, 	m_movie.ad_flag, 	m_movie.play_time, 	m_movie.rotate_flag, 	m_movie.ad_flag, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.movie_enc_file_size, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	m_movie.sound_enc_file_size, 	m_movie.sta_dt, 	m_movie.end_dt, 	m_movie.property_id, 	m_movie.update_user, 	m_client.client_id, 	m_client.client_name from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	exists( 		select 			1 		from 			t_movie_tag_rela 		where 			t_movie_tag_rela.movie_id = m_movie.movie_id and 			( 				t_movie_tag_rela.movie_tag_id = '1' 			) and 			t_movie_tag_rela.del_flag = 0 	)  and 	m_movie.sta_dt  '2018-02-01 00:00:00' or m_movie.end_dt is null) and 	m_movie.del__flag = 0 order by 	m_client.client_name, 	convert_to(m_movie.movie_name,'UTF8'), 	m_movie.movie_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 17:17:56 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_movie.del__flag does not exist
LINE 1: ...8-02-01 00:00:00' or m_movie.end_dt is null) and  m_movie.de...
                                                             ^ [ select 	m_movie.movie_id, 	m_movie.image_id, 	m_movie.movie_name, 	m_movie.ad_flag, 	m_movie.play_time, 	m_movie.rotate_flag, 	m_movie.ad_flag, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.movie_enc_file_size, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	m_movie.sound_enc_file_size, 	m_movie.sta_dt, 	m_movie.end_dt, 	m_movie.property_id, 	m_movie.update_user, 	m_client.client_id, 	m_client.client_name from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	exists( 		select 			1 		from 			t_movie_tag_rela 		where 			t_movie_tag_rela.movie_id = m_movie.movie_id and 			( 				t_movie_tag_rela.movie_tag_id = '1' 			) and 			t_movie_tag_rela.del_flag = 0 	)  and 	m_movie.sta_dt  '2018-02-01 00:00:00' or m_movie.end_dt is null) and 	m_movie.del__flag = 0 order by 	m_client.client_name, 	convert_to(m_movie.movie_name,'UTF8'), 	m_movie.movie_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_movie...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1538): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1317): Model_Playlist->sel_arr_movie_neco(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 17:23:56 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: arr_all_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
2018-02-26 17:23:56 --- STRACE: Kohana_Exception [ 0 ]: View variable is not set: arr_all_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
--
#0 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1565): Kohana_View->__get('arr_all_movie')
#1 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#2 [internal function]: Controller_Playlist->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}
2018-02-26 17:26:54 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: arr_all_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
2018-02-26 17:26:54 --- STRACE: Kohana_Exception [ 0 ]: View variable is not set: arr_all_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
--
#0 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1565): Kohana_View->__get('arr_all_movie')
#1 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#2 [internal function]: Controller_Playlist->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}
2018-02-26 18:07:36 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '$' ~ MODPATH/playlist/classes/controller/playlist.php [ 234 ]
2018-02-26 18:07:36 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '$' ~ MODPATH/playlist/classes/controller/playlist.php [ 234 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-26 18:08:55 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 1 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:08:55 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 2 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:08:55 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:08:55 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 1 and 	timezone_id = 1 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:08:55 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 1 and 	timezone_id = 2 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:08:55 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 1 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:10:51 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 1 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:10:51 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 2 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:10:51 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:10:51 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 1 and 	timezone_id = 1 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:10:51 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 1 and 	timezone_id = 2 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:10:51 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 1 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:12:42 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 1 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:12:42 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 1 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 18:15:21 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 1 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:15:21 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 1 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 18:17:20 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:17:20 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 18:36:48 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_ENDFOREACH ~ MODPATH/playlist/views/playlist.template.php [ 82 ]
2018-02-26 18:36:48 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_ENDFOREACH ~ MODPATH/playlist/views/playlist.template.php [ 82 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-26 18:48:06 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '=' ~ MODPATH/dev/classes/controller/dev.php [ 1241 ]
2018-02-26 18:48:06 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '=' ~ MODPATH/dev/classes/controller/dev.php [ 1241 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-26 18:50:14 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';', expecting T_VARIABLE or '$' ~ MODPATH/dev/classes/controller/dev.php [ 1273 ]
2018-02-26 18:50:14 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ';', expecting T_VARIABLE or '$' ~ MODPATH/dev/classes/controller/dev.php [ 1273 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-26 18:57:25 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:57:25 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 18:58:09 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:58:09 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 18:58:12 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:58:12 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 18:58:36 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:58:36 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 18:58:58 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 18:58:58 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 19:00:11 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:00:11 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 19:00:44 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:00:44 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 19:02:02 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:02:02 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 19:04:30 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:04:30 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 19:05:32 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:05:32 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 19:07:26 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:07:26 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select nextval(pg_catalog.pg_get_serial_sequence('t_playlist_rela', 'playlist_rela_id')) ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:07:26 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 166 and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:07:26 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 166 and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(2957): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(908): Model_Playlist->sel_arr_id_name_playlist_movie_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(805): Controller_Playlist->ins_playlist_rera(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(358): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-26 19:11:43 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:11:43 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:11:43 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:11:43 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:11:43 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:11:43 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:12:49 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-26 19:12:49 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/playlist.php(3132): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(250): Model_Playlist->sel_arr_playlist_rela(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-26 19:16:17 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_playlist_rela() ~ MODPATH/playlist/classes/controller/playlist.php [ 250 ]
2018-02-26 19:16:17 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_playlist_rela() ~ MODPATH/playlist/classes/controller/playlist.php [ 250 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-26 19:18:18 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_playlist_rela() ~ MODPATH/playlist/classes/controller/playlist.php [ 250 ]
2018-02-26 19:18:18 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_playlist_rela() ~ MODPATH/playlist/classes/controller/playlist.php [ 250 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}