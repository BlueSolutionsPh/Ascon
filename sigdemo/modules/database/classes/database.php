<?php defined('SYSPATH') or die('No direct script access.');

abstract class Database extends Kohana_Database {
	public function end($commit){
		$ret = $commit;
		if($commit){
			$ret = $this->commit();
		} else {
			try{
				$this->rollback();
			}catch(Exception $e){
				Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			}
		}
		return $ret;
	}
}
