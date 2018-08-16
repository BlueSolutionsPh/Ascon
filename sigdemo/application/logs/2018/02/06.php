<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-02-06 10:37:16 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 10:37:16 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(603): Model_Commonplaylist->sel_playlist('')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-06 10:37:21 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 10:37:21 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(603): Model_Commonplaylist->sel_playlist('')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-06 14:45:00 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 14:45:00 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(715): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(749): Model_Playlist->sel_playlist('')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(39): Controller_Playlist->disp_up_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-06 14:47:47 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 14:47:47 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(715): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(749): Model_Playlist->sel_playlist('')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(39): Controller_Playlist->disp_up_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-06 15:47:36 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "timezone_id" violates not-null constraint [ update 	t_playlist set 	playlist_name = 'プレイリストテスト0205_05', 	playlist_desc = NULL, 	image_intvl = 0, 	random_flag = 0, 	sex_id = NULL, 	timezone_id = NULL, 	deliverymonth_id = '1', 	sta_dt = '2018-02-01', 	end_dt = '2018-02-28', 	update_user = 'user_1', 	update_dt = '2018/02/06 15:47:36' where 	playlist_id = '43' and 	del_flag = 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 15:47:36 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '43' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '43' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 15:47:36 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '43' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '43' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_prog....', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1730): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1321): Model_Playlist->sel_arr_dev_by_playlist_id('43')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(857): Controller_Playlist->up()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-06 16:04:51 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "timezone_id" violates not-null constraint [ update 	t_playlist set 	playlist_name = 'プレイリストテスト0205_06', 	playlist_desc = NULL, 	image_intvl = 0, 	random_flag = 0, 	sex_id = NULL, 	timezone_id = NULL, 	deliverymonth_id = '1', 	sta_dt = '2018-02-01', 	end_dt = '2018-02-28', 	update_user = 'user_1', 	update_dt = '2018/02/06 16:04:50' where 	playlist_id = '44' and 	client_id = '1' and 	del_flag = 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 16:04:51 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 16:04:51 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_prog....', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1730): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1322): Model_Playlist->sel_arr_dev_by_playlist_id('44')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(857): Controller_Playlist->up()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-06 16:16:51 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 16:16:51 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(671): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(911): Model_Commonplaylist->sel_playlist('')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(711): Controller_Commonplaylist->up()
#4 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(45): Controller_Commonplaylist->disp_up()
#5 [internal function]: Controller_Commonplaylist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-06 16:37:45 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "timezone_id" violates not-null constraint [ update 	t_playlist set 	playlist_name = 'プレイリストテスト0205_05_1', 	playlist_desc = NULL, 	image_intvl = 0, 	random_flag = 0, 	sex_id = NULL, 	timezone_id = NULL, 	deliverymonth_id = '1', 	sta_dt = '2018-02-01', 	end_dt = '2018-02-28', 	update_user = 'user_1', 	update_dt = '2018/02/06 16:37:45' where 	playlist_id = '44' and 	client_id = '1' and 	del_flag = 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 16:37:45 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 16:37:45 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_prog....', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1730): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1322): Model_Playlist->sel_arr_dev_by_playlist_id('44')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(857): Controller_Playlist->up()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-06 16:59:17 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "timezone_id" violates not-null constraint [ update 	t_playlist set 	playlist_name = 'プレイリストテスト0205_05_1', 	playlist_desc = NULL, 	image_intvl = 0, 	random_flag = 0, 	sex_id = NULL, 	timezone_id = NULL, 	deliverymonth_id = '1', 	sta_dt = '2018-02-01', 	end_dt = '2018-02-28', 	update_user = 'user_1', 	update_dt = '2018/02/06 16:59:16' where 	playlist_id = '44' and 	client_id = '1' and 	del_flag = 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 16:59:17 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 16:59:17 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_prog....', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1730): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1322): Model_Playlist->sel_arr_dev_by_playlist_id('44')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(857): Controller_Playlist->up()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-06 16:59:45 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "timezone_id" violates not-null constraint [ update 	t_playlist set 	playlist_name = 'プレイリストテスト0205_06', 	playlist_desc = NULL, 	image_intvl = 0, 	random_flag = 0, 	sex_id = NULL, 	timezone_id = NULL, 	deliverymonth_id = '1', 	sta_dt = '2018-02-01', 	end_dt = '2018-02-28', 	update_user = 'user_1', 	update_dt = '2018/02/06 16:59:45' where 	playlist_id = '44' and 	client_id = '1' and 	del_flag = 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 16:59:45 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 16:59:45 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '44' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_prog....', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1730): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1322): Model_Playlist->sel_arr_dev_by_playlist_id('44')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(857): Controller_Playlist->up()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-06 17:02:36 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "timezone_id" violates not-null constraint [ update 	t_playlist set 	playlist_name = 'プレイリストテスト0205_06', 	playlist_desc = NULL, 	image_intvl = 0, 	random_flag = 0, 	sex_id = NULL, 	timezone_id = NULL, 	deliverymonth_id = '1', 	sta_dt = '2018-02-01', 	end_dt = '2018-02-28', 	update_user = 'user_1', 	update_dt = '2018/02/06 17:02:36' where 	playlist_id = '44' and 	client_id = '1' and 	del_flag = 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 17:54:10 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "t_playlist"
LINE 1: ....del_flag = 0 where  t_playlist.timezone_id  1  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_id) as cnt from ( select 	t_playlist.playlist_id from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_client on 	t_playlist.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	t_playlist.timezone_id  1 	t_playlist.del_flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 17:54:10 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "t_playlist"
LINE 1: ....del_flag = 0 where  t_playlist.timezone_id  1  t_playlist...
                                                             ^ [ select 	count(playlist.playlist_id) as cnt from ( select 	t_playlist.playlist_id from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_client on 	t_playlist.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	t_playlist.timezone_id  1 	t_playlist.del_flag = 0 ) playlist  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(p...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(319): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(83): Model_Commonplaylist->sel_cnt_playlist(Object(stdClass))
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(69): Controller_Commonplaylist->disp_list()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-06 18:08:05 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 18:08:05 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(673): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(612): Model_Commonplaylist->sel_playlist('')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-06 18:08:09 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 18:08:09 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(673): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(612): Model_Commonplaylist->sel_playlist('')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(39): Controller_Commonplaylist->disp_up_seltmpl()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-06 18:19:58 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "client_id" violates not-null constraint [ insert into 	t_playlist( 		playlist_id, 		draw_tmpl_id, 		client_id, 		playlist_name, 		playlist_desc, 		image_intvl, 		random_flag, 		ants_version, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		45, 		5, 		NULL, 		'プレイリストテスト0206_1', 		NULL, 		0, 		0, 		2, 		'1', 		'4', 		'1', 		'2018-02-01', 		'2018-02-28', 		'user_1', 		'2018/02/06 18:19:58', 		'user_1', 		'2018/02/06 18:19:58' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 18:25:20 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "client_id" violates not-null constraint [ insert into 	t_playlist( 		playlist_id, 		draw_tmpl_id, 		playlist_name, 		playlist_desc, 		image_intvl, 		random_flag, 		ants_version, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		46, 		5, 		'プレイリストテスト0206_01', 		NULL, 		0, 		0, 		2, 		'1', 		'3', 		'1', 		'2018-02-01', 		'2018-02-28', 		'user_1', 		'2018/02/06 18:25:20', 		'user_1', 		'2018/02/06 18:25:20' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 18:27:56 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "client_id" violates not-null constraint [ insert into 	t_playlist( 		playlist_id, 		draw_tmpl_id, 		playlist_name, 		playlist_desc, 		image_intvl, 		random_flag, 		ants_version, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		47, 		5, 		'プレイリストテスト0206_01', 		NULL, 		0, 		0, 		2, 		'1', 		'4', 		'1', 		'2018-02-01', 		'2018-02-28', 		'user_1', 		'2018/02/06 18:27:56', 		'user_1', 		'2018/02/06 18:27:56' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 18:31:04 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "client_id" violates not-null constraint [ insert into 	t_playlist( 		playlist_id, 		draw_tmpl_id, 		playlist_name, 		playlist_desc, 		image_intvl, 		random_flag, 		ants_version, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		48, 		5, 		'プレイリストテスト0206_1', 		NULL, 		0, 		0, 		2, 		'1', 		'4', 		'1', 		'2018-02-01', 		'2018-02-28', 		'user_1', 		'2018/02/06 18:31:04', 		'user_1', 		'2018/02/06 18:31:04' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 18:36:16 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  missing FROM-clause entry for table "m_client"
LINE 1: ... t_prog_rgl_grp.del_flag = 0  ) as prog_cnt_rgl,  m_client.c...
                                                             ^ [ select 	t_playlist.playlist_id, 	t_playlist.draw_tmpl_id, 	t_playlist.playlist_name, 	t_playlist.ants_version, 	t_playlist.sex_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, 	m_draw_tmpl.draw_tmpl_name, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				exists ( 					select 						t_prog_inner.prog_id 					from 						t_prog t_prog_inner 					where 						t_prog_outer.prog_id = t_prog_inner.prog_id and 						t_prog_outer.dev_id = t_prog_inner.dev_id and 						t_prog_inner.sta_dt  '2018/02/06 18:36:16' or t_prog_inner.end_dt is null) and 						t_prog_inner.del_flag = 0 				) and 				(t_prog_outer.end_dt > '2018/02/06 18:36:16' or t_prog_outer.end_dt is null) and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_now, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				t_prog_outer.sta_dt > '2018/02/06 18:36:16' and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_future, 	( 		select 			count(t_prog_rgl.prog_id) 		from 			t_prog_rgl_grp 		join 			t_prog_rgl 		on 			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 			t_prog_rgl.del_flag = 0 		join 			t_prog_playlist_rela 		on 			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 		where 			t_prog_rgl_grp.del_flag = 0 	) as prog_cnt_rgl, 	m_client.client_id, 	m_client.client_name, 	m_timezone.timezone_id, 	m_timezone.timezone_name from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_timezone on 	t_playlist.timezone_id = m_timezone.timezone_id and 	m_timezone.del_flag = 0 where 	t_playlist.timezone_id  1 and 	t_playlist.del_flag = 0 order by 	convert_to(t_playlist.playlist_name,'UTF8'), 	t_playlist.playlist_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-06 18:36:16 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  missing FROM-clause entry for table "m_client"
LINE 1: ... t_prog_rgl_grp.del_flag = 0  ) as prog_cnt_rgl,  m_client.c...
                                                             ^ [ select 	t_playlist.playlist_id, 	t_playlist.draw_tmpl_id, 	t_playlist.playlist_name, 	t_playlist.ants_version, 	t_playlist.sex_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, 	m_draw_tmpl.draw_tmpl_name, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				exists ( 					select 						t_prog_inner.prog_id 					from 						t_prog t_prog_inner 					where 						t_prog_outer.prog_id = t_prog_inner.prog_id and 						t_prog_outer.dev_id = t_prog_inner.dev_id and 						t_prog_inner.sta_dt  '2018/02/06 18:36:16' or t_prog_inner.end_dt is null) and 						t_prog_inner.del_flag = 0 				) and 				(t_prog_outer.end_dt > '2018/02/06 18:36:16' or t_prog_outer.end_dt is null) and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_now, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				t_prog_outer.sta_dt > '2018/02/06 18:36:16' and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_future, 	( 		select 			count(t_prog_rgl.prog_id) 		from 			t_prog_rgl_grp 		join 			t_prog_rgl 		on 			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 			t_prog_rgl.del_flag = 0 		join 			t_prog_playlist_rela 		on 			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 		where 			t_prog_rgl_grp.del_flag = 0 	) as prog_cnt_rgl, 	m_client.client_id, 	m_client.client_name, 	m_timezone.timezone_id, 	m_timezone.timezone_name from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_timezone on 	t_playlist.timezone_id = m_timezone.timezone_id and 	m_timezone.del_flag = 0 where 	t_playlist.timezone_id  1 and 	t_playlist.del_flag = 0 order by 	convert_to(t_playlist.playlist_name,'UTF8'), 	t_playlist.playlist_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_playl...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(584): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(94): Model_Commonplaylist->sel_arr_playlist(Object(stdClass))
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(69): Controller_Commonplaylist->disp_list()
#4 [internal function]: Controller_Commonplaylist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}