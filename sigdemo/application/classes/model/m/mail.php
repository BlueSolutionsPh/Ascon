<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Mail extends Model
{
	protected $db;
	public function __construct(&$db, $client_id)
	{
		$this->db = $db;
		$this->client_id = $client_id;
	}
	
	/**
	 * Email address Primary key number assignment
	 *
	 * @return int		Number assigned client_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_mail', 'mail_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * E-mail address registration
	 *
	 * @param stdClass	$mail		mail address
	 * @return bool					true = success, false = failure
	 */
	public function ins($mail)
	{
		$query_str = "insert into ";
		$query_str .= "	m_mail( ";
		$query_str .= "		mail_id, ";
		$query_str .= "		client_id, ";
		$query_str .= "		mail_addr, ";
		$query_str .= "		note, ";
		$query_str .= "		disp_order, ";
		$query_str .= "		create_user, ";
		$query_str .= "		create_dt, ";
		$query_str .= "		update_user, ";
		$query_str .= "		update_dt ";
		$query_str .= "	) values ( ";
		$query_str .= "		:mail_id, ";
		$query_str .= "		:client_id, ";
		$query_str .= "		:mail_addr, ";
		$query_str .= "		:note, ";
		$query_str .= "		:disp_order, ";
		$query_str .= "		:create_user, ";
		$query_str .= "		:create_dt, ";
		$query_str .= "		:update_user, ";
		$query_str .= "		:update_dt ";
		$query_str .= "	) ";
		
		$arr_bind_param = array();
		$arr_bind_param[":mail_id"] = $mail->mail_id;
		$arr_bind_param[":client_id"] = $this->client_id;
		$arr_bind_param[":mail_addr"] = $mail->mail_addr;
		$arr_bind_param[":note"] = $mail->note;
		$arr_bind_param[":disp_order"] = $mail->disp_order;
		$arr_bind_param[":create_user"] = $mail->create_user;
		$arr_bind_param[":create_dt"] = $mail->create_dt;
		$arr_bind_param[":update_user"] = $mail->update_user;
		$arr_bind_param[":update_dt"] = $mail->update_dt;
		
		$query = DB::query(Database::INSERT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Email address update
	 *
	 * @param stdClass	$mail		mail address
	 * @return bool					true = success, false = failure
	 */
	public function up($mail)
	{
		$query_str = "update ";
		$query_str .= "	m_mail ";
		$query_str .= "set ";
		$query_str .= "	mail_addr = :mail_addr, ";
		$query_str .= "	note = :note, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	mail_id = :mail_id and ";
		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
	
		$arr_bind_param = array();
		$arr_bind_param[":mail_id"] = $mail->mail_id;
		$arr_bind_param[":client_id"] = $this->client_id;
		$arr_bind_param[":mail_addr"] = $mail->mail_addr;
		$arr_bind_param[":note"] = $mail->note;
		$arr_bind_param[":update_user"] = $mail->update_user;
		$arr_bind_param[":update_dt"] = $mail->update_dt;
	
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
	
	/**
	 * Acquire ID from email address
	 *
	 * @param String	$serial_no		Serial number
	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_mail_no($mail)
	{
		$query_str = "select ";
		$query_str .= "	m_mail.mail_id ";
		$query_str .= "from ";
		$query_str .= "	m_mail ";
		$query_str .= "where ";
		$query_str .= "	m_mail.client_id = :client_id and ";
		$query_str .= "	m_mail.mail_addr = :mail_addr and ";
		$query_str .= "	m_mail.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":client_id"] = $this->client_id;
		$arr_bind_param[":mail_addr"] = $mail;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Mail ID acquisition (existence confirmation)
	 *
	 * @param String	$mail_id	Mail ID
	 * @return array				Acquisition record
	 */
	public function sel_id($mail_id)
	{
		$arr_bind_param = array();
	
		$query_str = "select ";
		$query_str .= "	m_mail.mail_id ";
		$query_str .= "from ";
		$query_str .= "	m_mail ";
		$query_str .= "where ";
		$query_str .= "	m_mail.mail_id = :mail_id and ";
		$query_str .= "	m_mail.client_id = :client_id and ";
		$query_str .= "	m_mail.del_flag = 0 ";
		
		$arr_bind_param[":mail_id"] = $mail_id;
		$arr_bind_param[":client_id"] = $this->client_id;
	
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db, true);
	}
	
	/**
	 * Delete mail address
	 *
	 * @param stdClass	$mail		mail address
	 * @return bool					true = success, false = failure
	 */
	public function del($mail)
	{
		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	m_mail ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	mail_id = :mail_id and ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
				
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $mail->update_user;
			$arr_bind_param[":update_dt"] = $mail->update_dt;
			$arr_bind_param[":mail_id"] = $mail->mail_id;
			$arr_bind_param[":client_id"] = $this->client_id;
	
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
				
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}