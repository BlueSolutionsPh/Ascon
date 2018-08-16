<?php defined('SYSPATH') or die('No direct script access.'); ?>

2016-11-02 11:45:23 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: 0000000001/movie/0000000002.mp4 ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2016-11-02 11:45:23 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: 0000000001/movie/0000000002.mp4 ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /var/www/html/ants2/index.php(109): Kohana_Request->execute()
#1 {main}
2016-11-02 11:46:06 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: 0000000001/movie/0000000000/0000000002.mp4 ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2016-11-02 11:46:06 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: 0000000001/movie/0000000000/0000000002.mp4 ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /var/www/html/ants2/index.php(109): Kohana_Request->execute()
#1 {main}
2016-11-02 11:55:43 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: home/cts/orignal/0000000001/movie/0000000000/0000000002.mp4 ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2016-11-02 11:55:43 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: home/cts/orignal/0000000001/movie/0000000000/0000000002.mp4 ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /var/www/html/ants2/index.php(109): Kohana_Request->execute()
#1 {main}