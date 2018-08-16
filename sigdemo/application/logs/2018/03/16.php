<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-03-16 19:12:55 --- ERROR: Database_Exception [ 22008 ]: SQLSTATE[22008]: Datetime field overflow: 7 ERROR:  date/time field value out of range: "2018-04-0100:00:00"
LINE 1: ...rog_inner.dev_id and       t_prog_inner.sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-16 19:12:55 --- STRACE: Database_Exception [ 22008 ]: SQLSTATE[22008]: Datetime field overflow: 7 ERROR:  date/time field value out of range: "2018-04-0100:00:00"
LINE 1: ...rog_inner.dev_id and       t_prog_inner.sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_playl...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(955): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1415): Model_Playlist->sel_arr_playlist_overlap(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(181): Controller_Playlist->check_overlap(Array)
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(143): Controller_Playlist->ins_seltmpl()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}