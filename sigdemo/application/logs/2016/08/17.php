<?php defined('SYSPATH') or die('No direct script access.'); ?>

2016-08-17 09:31:14 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_property" does not exist
LINE 1: ...erty.property_id,  m_property.property_name from  m_property...
                                                             ^ [ select 	m_property.property_id, 	m_property.property_name from 	m_property join 	m_client on 	m_property.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_property.client_id = '1' and 	m_property.del_flag = 0 order by 	m_property.property_name, 	m_property.property_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]