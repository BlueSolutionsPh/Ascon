<?php
class Xml_Text{
	private $text_id;		//Text ID
	private $display_order;	//Display order
	private $text_name;		//Text name
	private $text_msg;		//Text message
	private $sta_dt;			//Valid period start date and time
	private $end_dt;			//Valid period end date and time
	private $x;				//Drawing area reference point X coordinate
	private $y;				//Drawing area reference point Y coordinate
	private $width;			//Drawing area width
	private $height;		//Drawing area height
	
	/**
	 * constructor
	 */
	public function __construct($text_row){
		$text_id = $text_row["text_id"];
		$text_name = $text_row["text_name"];
		$text_msg = $text_row["text_msg"];
		$display_order = $text_row["display_order"];
		$sta_dt = $text_row["sta_dt"];
		$end_dt = $text_row["end_dt"];
		$x = $text_row["x"];
		$y = $text_row["y"];
		$width = $text_row["width"];
		$height = $text_row["height"];
		
		$this->set_text_id($text_id);
		$this->set_text_name($text_name);
		$this->set_text_msg($text_msg);
		$this->set_display_order($display_order);
		$this->set_sta_dt($sta_dt);
		$this->set_end_dt($end_dt);
		$this->set_x($x);
		$this->set_y($y);
		$this->set_width($width);
		$this->set_height($height);
	}
	
	/**
	 * Accessor
	 */
	public function set_text_id($text_id){
		$this->text_id = $text_id;
	}
	public function get_text_id(){
		return $this->text_id;
	}
	public function set_display_order($display_order){
		$this->display_order = $display_order;
	}
	public function get_display_order(){
		return $this->display_order;
	}
	public function set_text_name($text_name){
		$this->text_name = $text_name;
	}
	public function get_text_name(){
		return $this->text_name;
	}
	public function set_text_msg($text_msg){
		$this->text_msg = $text_msg;
	}
	public function get_text_msg(){
		return $this->text_msg;
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
	public function set_x($x){
		$this->x = $x;
	}
	public function get_x(){
		return $this->x;
	}
	public function set_y($y){
		$this->y = $y;
	}
	public function get_y(){
		return $this->y;
	}
	public function set_width($width){
		$this->width = $width;
	}
	public function get_width(){
		return $this->width;
	}
	public function set_height($height){
		$this->height = $height;
	}
	public function get_height(){
		return $this->height;
	}
	
	/**
	 * _xML generation
	 */
	public function set_as_child_node($dom, &$parent_node){
		$node_text = $parent_node->appendChild($dom->createElement("text"));
		
		//Text ID
		$node_text_id = $node_text->appendChild($dom->createElement("textId"));
		$node_text_id->appendChild($dom->createTextNode($this->text_id));
		
		//Display order
		$node_display_order = $node_text->appendChild($dom->createElement("displayOrder"));
		$node_display_order->appendChild($dom->createTextNode($this->display_order));
		
		//Text name
		$node_text_name = $node_text->appendChild($dom->createElement("textName"));
		$node_text_name->appendChild($dom->createTextNode($this->text_name));
		
		//Text message
		$node_text_msg = $node_text->appendChild($dom->createElement("textMsg"));
		$node_text_msg->appendChild($dom->createTextNode($this->text_msg));
		
		//Valid period start date and time
		if(!empty($this->sta_dt)){
			$node_sta_dt = $node_text->appendChild($dom->createElement("staDt"));
			$node_sta_dt->appendChild($dom->createTextNode($this->sta_dt));
		}
		
		//Valid period end date and time
		if(!empty($this->end_dt)){
			$node_end_dt = $node_text->appendChild($dom->createElement("endDt"));
			$node_end_dt->appendChild($dom->createTextNode($this->end_dt));
		}
		
		//Drawing area reference point _ x coordinate
		if(!is_null($this->x)){
			$node_x = $node_text->appendChild($dom->createElement("x"));
			$node_x->appendChild($dom->createTextNode($this->x));
		}
		
		//Drawing area reference point_y coordinate
		if(!is_null($this->y)){
			$node_y = $node_text->appendChild($dom->createElement("y"));
			$node_y->appendChild($dom->createTextNode($this->y));
		}
		
		//Drawing area width
		if(!is_null($this->width)){
			$node_width = $node_text->appendChild($dom->createElement("width"));
			$node_width->appendChild($dom->createTextNode($this->width));
		}
		
		//Drawing area height
		if(!is_null($this->height)){
			$node_height = $node_text->appendChild($dom->createElement("height"));
			$node_height->appendChild($dom->createTextNode($this->height));
		}
	}
}
?>