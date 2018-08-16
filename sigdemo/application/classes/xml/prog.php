<?php
class Xml_Prog{
	private $prog_id;			//Program guide ID
	private $sta_dt;				//Distribution start date and time
	private $end_dt;				//Delivery end date and time
	private $arr_playlist;		//Playlist array
	
	/**
	 * constructor
	 */
	function __construct()
	{
		$this->arr_playlist = array();
	}
	
	/**
	 * Accessor
	 */
	public function set_prog_id($prog_id){
		$this->prog_id = $prog_id;
	}
	public function get_prog_id(){
		return $this->prog_id;
	}
	public function set_sta_dt($sta_dt){
		$this->sta_dt = $sta_dt;
	}
	public function get_sta_dt(){
		return $this->sta_dt;
	}
	public function set_end_dt($end_dt){
		$this->end_dt = $end_dt;
	}
	public function get_end_dt(){
		return $this->end_dt;
	}
	public function set_arr_playlist($arr_playlist){
		$this->arr_playlist = $arr_playlist;
	}
	public function get_arr_playlist(){
		return $this->arr_playlist;
	}
	public function add_arr_playlist($playlist){
		array_push($this->arr_playlist, $playlist);
	}
	
	/**
	 * XML generation
	 */
	public function set_as_child_node($dom, &$parent_node){
		$node_prog = $parent_node->appendChild($dom->createElement("prog"));
		if(!is_null($this->prog_id)){
			//With program guide ID
			$node_prog_id = $node_prog->appendChild($dom->createElement("progId"));
			$node_prog_id->appendChild($dom->createTextNode($this->prog_id));
			
			$node_sta_dt = $node_prog->appendChild($dom->createElement("staDt"));
			$node_sta_dt->appendChild($dom->createTextNode($this->sta_dt));
			
			$node_end_dt = $node_prog->appendChild($dom->createElement("endDt"));
			$node_end_dt->appendChild($dom->createTextNode($this->end_dt));
			
			if(!empty($this->arr_playlist)){
				//With playlist setting
				$node_arr_playlist = $node_prog->appendChild($dom->createElement("arrPlaylist"));
				foreach($this->arr_playlist as $playlist){
					$playlist->set_as_child_node($dom, $node_arr_playlist);
				}
			} else {
				//No playlist setting
			}
		} else {
			//No program guide
		}
	}
}
?>