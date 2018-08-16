<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-11 09:53:23 --- ERROR: ReflectionException [ 0 ]: Function booth_name_exists() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
2018-01-11 09:53:23 --- STRACE: ReflectionException [ 0 ]: Function booth_name_exists() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/validation.php(383): ReflectionFunction->__construct('booth_name_exis...')
#1 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(150): Kohana_Validation->check()
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(101): Controller_Booth->ins_validation()
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(15): Controller_Booth->disp_ins()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-11 11:08:57 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "_id"
LINE 1: ... values (   14,   'ブース2_2',   '2',   '3',   '1'_id,   '1'...
                                                             ^ [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 		twentyfour_flg, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		14, 		'ブース2_2', 		'2', 		'3', 		'1'_id, 		'1', 		NULL, 		'12345678', 		'12345678', 		'user_1', 		'2018/01/11 11:08:57', 		'user_1', 		'2018/01/11 11:08:57' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-11 11:12:35 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  INSERT has more expressions than target columns
LINE 1: ...12345678',   'user_1',   '2018/01/11 11:12:35',   'user_1', ...
                                                             ^ [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 		twentyfour_flg, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		16, 		'ブース2_3', 		'2', 		'3', 		'1', 		'1', 		'1', 		600, 		10, 		'12345678', 		'12345678', 		'user_1', 		'2018/01/11 11:12:35', 		'user_1', 		'2018/01/11 11:12:35' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-11 11:12:44 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  INSERT has more expressions than target columns
LINE 1: ...12345678',   'user_1',   '2018/01/11 11:12:44',   'user_1', ...
                                                             ^ [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 		twentyfour_flg, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		17, 		'ブース2_3', 		'2', 		'3', 		'1', 		'1', 		NULL, 		600, 		10, 		'12345678', 		'12345678', 		'user_1', 		'2018/01/11 11:12:44', 		'user_1', 		'2018/01/11 11:12:44' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-11 11:12:57 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  INSERT has more expressions than target columns
LINE 1: ...12345678',   'user_1',   '2018/01/11 11:12:57',   'user_1', ...
                                                             ^ [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 		twentyfour_flg, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		18, 		'ブース2_3', 		'2', 		'3', 		'1', 		'1', 		'1', 		0, 		0, 		'12345678', 		'12345678', 		'user_1', 		'2018/01/11 11:12:57', 		'user_1', 		'2018/01/11 11:12:57' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-11 11:13:03 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  INSERT has more expressions than target columns
LINE 1: ...12345678',   'user_1',   '2018/01/11 11:13:03',   'user_1', ...
                                                             ^ [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 		twentyfour_flg, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		19, 		'ブース2_3', 		'2', 		'3', 		'1', 		'1', 		NULL, 		0, 		0, 		'12345678', 		'12345678', 		'user_1', 		'2018/01/11 11:13:03', 		'user_1', 		'2018/01/11 11:13:03' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-11 11:14:29 --- ERROR: Database_Exception [ 42804 ]: SQLSTATE[42804]: Datatype mismatch: 7 ERROR:  column "sta_time" is of type time without time zone but expression is of type integer
LINE 1: ...'ブース2_3',   '2',   '3',   '1',   '1',   '1',   620,   730...
                                                             ^
HINT:  You will need to rewrite or cast the expression. [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 		twentyfour_flg, 	    sta_time, 	    end_time, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		20, 		'ブース2_3', 		'2', 		'3', 		'1', 		'1', 		'1', 		620, 		730, 		'12345678', 		'12345678', 		'user_1', 		'2018/01/11 11:14:29', 		'user_1', 		'2018/01/11 11:14:29' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-11 11:15:28 --- ERROR: Database_Exception [ 42804 ]: SQLSTATE[42804]: Datatype mismatch: 7 ERROR:  column "sta_time" is of type time without time zone but expression is of type integer
LINE 1: ... 21,   'ブース2_3',   '2',   '3',   '1',   '1',   610,   730...
                                                             ^
HINT:  You will need to rewrite or cast the expression. [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 	    sta_time, 	    end_time, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		21, 		'ブース2_3', 		'2', 		'3', 		'1', 		'1', 		610, 		730, 		'12345678', 		'12345678', 		'user_1', 		'2018/01/11 11:15:28', 		'user_1', 		'2018/01/11 11:15:28' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-11 11:38:08 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '{' ~ MODPATH/booth/classes/controller/booth.php [ 188 ]
2018-01-11 11:38:08 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '{' ~ MODPATH/booth/classes/controller/booth.php [ 188 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-11 11:40:48 --- ERROR: Database_Exception [ 42804 ]: SQLSTATE[42804]: Datatype mismatch: 7 ERROR:  column "sta_time" is of type time without time zone but expression is of type integer
LINE 1: ... 'ブース1_2',   '1',   '2',   '61',   '1',   0,   610,   671...
                                                             ^
HINT:  You will need to rewrite or cast the expression. [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 		twentyfour_flg, 	    sta_time, 	    end_time, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		28, 		'ブース1_2', 		'1', 		'2', 		'61', 		'1', 		0, 		610, 		671, 		'12345678', 		'12345678', 		'user_1', 		'2018/01/11 11:40:47', 		'user_1', 		'2018/01/11 11:40:47' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-11 11:49:41 --- ERROR: ReflectionException [ 0 ]: Function booth_name_exists_exclude_id() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
2018-01-11 11:49:41 --- STRACE: ReflectionException [ 0 ]: Function booth_name_exists_exclude_id() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/validation.php(383): ReflectionFunction->__construct('booth_name_exis...')
#1 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(320): Kohana_Validation->check()
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(258): Controller_Booth->up_validation()
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(21): Controller_Booth->disp_up()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-11 11:55:00 --- ERROR: ReflectionException [ 0 ]: Function booth_name_exists_exclude_id() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
2018-01-11 11:55:00 --- STRACE: ReflectionException [ 0 ]: Function booth_name_exists_exclude_id() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/validation.php(383): ReflectionFunction->__construct('booth_name_exis...')
#1 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(320): Kohana_Validation->check()
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(258): Controller_Booth->up_validation()
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(21): Controller_Booth->disp_up()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-11 12:01:24 --- ERROR: ReflectionException [ 0 ]: Function booth_name_exists_exclude_id() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
2018-01-11 12:01:24 --- STRACE: ReflectionException [ 0 ]: Function booth_name_exists_exclude_id() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/validation.php(383): ReflectionFunction->__construct('booth_name_exis...')
#1 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(320): Kohana_Validation->check()
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(258): Controller_Booth->up_validation()
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(21): Controller_Booth->disp_up()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-11 13:00:41 --- ERROR: ReflectionException [ 0 ]: Function booth_name_exists_exclude_id() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
2018-01-11 13:00:41 --- STRACE: ReflectionException [ 0 ]: Function booth_name_exists_exclude_id() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/validation.php(383): ReflectionFunction->__construct('booth_name_exis...')
#1 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(320): Kohana_Validation->check()
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(258): Controller_Booth->up_validation()
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(21): Controller_Booth->disp_up()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-11 13:13:29 --- ERROR: ReflectionException [ 0 ]: Function booth_name_exists_exclude_id() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
2018-01-11 13:13:29 --- STRACE: ReflectionException [ 0 ]: Function booth_name_exists_exclude_id() does not exist ~ SYSPATH/classes/kohana/validation.php [ 383 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/validation.php(383): ReflectionFunction->__construct('booth_name_exis...')
#1 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(320): Kohana_Validation->check()
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(258): Controller_Booth->up_validation()
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(21): Controller_Booth->disp_up()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-11 14:11:08 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '=' ~ MODPATH/booth/views/booth.up.template.php [ 47 ]
2018-01-11 14:11:08 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '=' ~ MODPATH/booth/views/booth.up.template.php [ 47 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-11 14:17:43 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/booth/views/booth.up.template.php [ 47 ]
2018-01-11 14:17:43 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/booth/views/booth.up.template.php [ 47 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-11 14:39:33 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth_tag" does not exist
LINE 1: select  booth_tag_id,  booth_tag_name from  m_booth_tag wher...
                                                    ^ [ select 	booth_tag_id, 	booth_tag_name from 	m_booth_tag where 	exists( 		select 			1 		from 			t_booth_tag_rela 		join 			m_booth 		on 			t_booth_tag_rela.booth_id = m_booth.booth_id and 			m_booth.booth_id = '30' and 			m_booth.del_flag = 0 		where 			m_booth_tag.booth_tag_id = t_booth_tag_rela.booth_tag_id and 			t_booth_tag_rela.del_flag = 0 	) and 	del_flag = 0 order by 	booth_tag_name, 	booth_tag_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-11 14:39:33 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth_tag" does not exist
LINE 1: select  booth_tag_id,  booth_tag_name from  m_booth_tag wher...
                                                    ^ [ select 	booth_tag_id, 	booth_tag_name from 	m_booth_tag where 	exists( 		select 			1 		from 			t_booth_tag_rela 		join 			m_booth 		on 			t_booth_tag_rela.booth_id = m_booth.booth_id and 			m_booth.booth_id = '30' and 			m_booth.del_flag = 0 		where 			m_booth_tag.booth_tag_id = t_booth_tag_rela.booth_tag_id and 			t_booth_tag_rela.del_flag = 0 	) and 	del_flag = 0 order by 	booth_tag_name, 	booth_tag_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?booth_t...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(472): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(385): Model_Booth->sel_arr_booth_tag_by_booth_id('30')
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(243): Controller_Booth->up()
#4 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(21): Controller_Booth->disp_up()
#5 [internal function]: Controller_Booth->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-11 14:46:32 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "floor" of relation "m_booth" does not exist
LINE 1: ...= 'ブース1_3',  client_id = '1',  shop_id = '2',  floor = NU...
                                                             ^ [ update 	m_booth set 	booth_name = 'ブース1_3', 	client_id = '1', 	shop_id = '2', 	floor = NULL, 	sex_id = '1', 	twentyfour_flg = 0, 	sta_time = '20:15:00', 	end_time = '20:20:00', 	wifissid = '12345679', 	wifipass = '12345677', 	update_user = 'user_1', 	update_dt = '2018/01/11 14:46:32' where 	client_id = '1' and 	booth_id = '30' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-11 14:55:47 --- ERROR: ErrorException [ 1 ]: Class 'Model_T_Booth_Tag_Rela' not found ~ MODPATH/booth/classes/model/booth.php [ 761 ]
2018-01-11 14:55:47 --- STRACE: ErrorException [ 1 ]: Class 'Model_T_Booth_Tag_Rela' not found ~ MODPATH/booth/classes/model/booth.php [ 761 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-11 15:08:03 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting ')' ~ MODPATH/booth/views/booth.up.template.php [ 46 ]
2018-01-11 15:08:03 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting ')' ~ MODPATH/booth/views/booth.up.template.php [ 46 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-11 15:10:30 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/booth/views/booth.up.template.php [ 46 ]
2018-01-11 15:10:30 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/booth/views/booth.up.template.php [ 46 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-11 15:10:33 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/booth/views/booth.up.template.php [ 46 ]
2018-01-11 15:10:33 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/booth/views/booth.up.template.php [ 46 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-11 15:37:56 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_DOUBLE_ARROW ~ MODPATH/booth/views/booth.up.template.php [ 46 ]
2018-01-11 15:37:56 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_DOUBLE_ARROW ~ MODPATH/booth/views/booth.up.template.php [ 46 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-11 15:38:35 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_DOUBLE_ARROW ~ MODPATH/booth/views/booth.up.template.php [ 46 ]
2018-01-11 15:38:35 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_DOUBLE_ARROW ~ MODPATH/booth/views/booth.up.template.php [ 46 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}