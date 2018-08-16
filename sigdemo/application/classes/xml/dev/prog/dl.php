<?php
class Xml_Dev_Prog_Dl{
	private $dev_prog_dl_log_id;	//Terminal program guide download ID
	private $arr_prog;			//Program guide array
	
	/**
	 * constructor
	 */
	function __construct()
	{
		$this->arr_prog = array();
	}
	
	/**
	 * Accessor
	 */
	public function set_dev_prog_dl_log_id($dev_prog_dl_log_id){
		$this->dev_prog_dl_log_id = $dev_prog_dl_log_id;
	}
	public function get_dev_prog_dl_log_id(){
		return $this->dev_prog_dl_log_id;
	}
	public function set_arr_prog($arr_prog){
		$this->arr_prog = $arr_prog;
	}
	public function get_arr_prog(){
		return $this->arr_prog;
	}
	public function add_arr_prog($prog){
		array_push($this->arr_prog, $prog);
	}
	
	/**
	 * XML string generation
	 */
	public function get_xml(){
		$dom = new DomDocument('1.0');
		$dom->encoding = "UTF-8";
		$dom->formatOutput = true;
		$this->set_as_child_node($dom, $dom);
		
		return $dom->saveXML();
	}
	
	/**
	 * XML generation
	 */
	public function set_as_child_node($dom, &$parent_node){
		$node_dev_prog_dl = $dom->appendChild($dom->createElement("devProgDl"));	//Route node
		
		//Terminal program guide download ID
		$node_dev_prog_dl_log_id = $node_dev_prog_dl->appendChild($dom->createElement("devProgDlLogId"));
		$node_dev_prog_dl_log_id->appendChild($dom->createTextNode($this->dev_prog_dl_log_id));
		
		if(!empty($this->arr_prog)){
			//With program guide setting
			$node_arr_prog = $node_dev_prog_dl->appendChild($dom->createElement("arrProg"));
			foreach($this->arr_prog as $prog){
				$prog->set_as_child_node($dom, $node_arr_prog);
			}
		} else {
			//No program guide setting
		}
	}
}
?>