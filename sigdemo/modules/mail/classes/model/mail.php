<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Mail extends Model
{
	public $db;
	public $client_id;

	public function __construct($client_id)
	{
		$this->db = Database::instance();
		if($client_id !== false){
			$this->client_id = $client_id;
		} else {
			$this->client_id = null;
		}
	}

	/**
	 * Device main key number assignment
	 *
	 * @return int		The assigned dev_id
	 */
	public function sel_next_mail_id()
	{
		$mail_id = null;
		try{
			$m_mail = new Model_M_Mail($this->db, $this->client_id);
			$mail_id = $m_mail->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$mail_id = null;
		}
		return $mail_id;
	}

	/**
	 * Acquire e-mail address number
	 *
	 * @param
	 * @return array				Acquisition record
	 */
	public function sel_cnt_mail()
	{
		$query_str = "select ";
		$query_str .= "	count(*) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_mail ";
		$query_str .= "where ";
		$query_str .= "	m_mail.client_id = :client_id and ";
		$query_str .= "	m_mail.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":client_id"] = $this->client_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get e-mail address list
	 * @param
	 * @return array				Acquisition record
	 */
	public function sel_arr_mail()
	{
		$query_str = "select ";
		$query_str .= "	m_mail.mail_id, ";
		$query_str .= "	m_mail.mail_addr, ";
		$query_str .= "	m_mail.note ";
		$query_str .= "from ";
		$query_str .= "	m_mail ";
		$query_str .= "where ";
		$query_str .= "	m_mail.client_id = :client_id and ";
		$query_str .= "	m_mail.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_mail.disp_order ";

		$arr_bind_param = array();
		$arr_bind_param[":client_id"] = $this->client_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get email address
	 *
	 * @param String	$mail_id	Mail ID
	 * @return array				Acquisition record
	 */
	public function sel_mail($mail_id)
	{
		$query_str = "select ";
		$query_str .= "	m_mail.mail_id, ";
		$query_str .= "	m_mail.client_id, ";
		$query_str .= "	m_mail.mail_addr, ";
		$query_str .= "	m_mail.disp_order, ";
		$query_str .= "	m_mail.note ";
		$query_str .= "from ";
		$query_str .= "	m_mail ";
		$query_str .= "where ";
		$query_str .= "	m_mail.mail_id = :mail_id and ";
		$query_str .= "	m_mail.client_id = :client_id and ";
		$query_str .= "	m_mail.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":mail_id"] = $mail_id;
		$arr_bind_param[":client_id"] = $this->client_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * E-mail address registration
	 *
	 * @param stdClass	$mail		mail address
	 * @return bool				true = success, false = failure
	 */
	public function ins_mail($mail)
	{
		$ret = true;
		try{
			$m_mail = new Model_M_Mail($this->db, $this->client_id);
			$m_mail->ins($mail);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}

	/**
	 * Email address update
	 *
	 * @param stdClass	$mail		mail address
	 * @return bool				true = success, false = failure
	 */
	public function up_mail($mail)
	{
		$ret = true;
		try{
			$m_mail = new Model_M_Mail($this->db, $this->client_id);
			$m_mail->up($mail);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}

	/**
	 * Delete mail address
	 *
	 * @param String	$mail		mail address
	 * @return bool					true = success, false = failure
	 */
	public function del_mail($mail)
	{
		$ret = true;
		try{
			//Mail address master
			$m_mail = new Model_M_Mail($this->db, $this->client_id);
			$m_mail->del($mail);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}
}
