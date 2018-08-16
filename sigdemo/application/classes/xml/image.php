<?php
class Xml_Image{
	private $image_id;		//Image ID
	private $display_order;	//Display order
	private $image_name;	//Image name
	private $sta_dt;		//Valid period start date and time
	private $end_dt;		//Valid period end date and time
	private $image_file;	//Image file
	private $x;				//Drawing area reference point X coordinate
	private $y;				//Drawing area reference point Y coordinate
	private $width;			//Drawing area width
	private $height;		//Drawing area height
	
	/**
	 * constructor
	 */
	public function __construct($image_row, $playlist_id, $login_acnt, $passwd, $request){
		$image_id = $image_row["image_id"];
		$image_name = $image_row["image_name"];
		$display_order = $image_row["display_order"];
		$orig_hash = $image_row["orig_hash"];
		$orig_file_dir = $image_row["orig_file_dir"];
		if(ENCRYPT_ENABLED){
			$file_size = $image_row["enc_file_size"];
		} else {
			$file_size = $image_row["orig_file_size"];
		}
		$origfile_size = $image_row["orig_file_size"];
		$sta_dt = $image_row["sta_dt"];
		$end_dt = $image_row["end_dt"];
		$file_name = $image_row["file_name"];
		$orig_file_exte = $image_row["orig_file_exte"];
		$x = $image_row["x"];
		$y = $image_row["y"];
		$width = $image_row["width"];
		$height = $image_row["height"];
		
		$image_file = new Xml_File();
		$image_file->set_orig_hash($orig_hash);
		$image_file->set_file_size($file_size);
		$image_file->set_Orig_file_size($origfile_size);
		$image_file->set_url_1(URL::base("https") . MODULE_NAME_PLAYLISTDL . "/index/" . $login_acnt . "/" . $passwd . "/" .$playlist_id . "/" . IMAGE_FILE_DIR . $file_name . $orig_file_exte);
		$this->set_image_file($image_file);
		$this->set_image_id($image_id);
		$this->set_image_name($image_name);
		$this->set_display_order($display_order);
		$this->set_sta_dt($sta_dt);
		$this->set_end_dt($end_dt);
		$this->set_image_file($image_file);
		$this->set_x($x);
		$this->set_y($y);
		$this->set_width($width);
		$this->set_height($height);
	}
	
	/**
	 * Accessor
	 */
	public function set_image_id($image_id){
		$this->image_id = $image_id;
	}
	public function get_image_id(){
		return $this->image_id;
	}
	public function set_display_order($display_order){
		$this->display_order = $display_order;
	}
	public function get_display_order(){
		return $this->display_order;
	}
	public function set_image_name($image_name){
		$this->image_name = $image_name;
	}
	public function get_image_name(){
		return $this->image_name;
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
	public function set_image_file($image_file){
		$this->image_file = $image_file;
	}
	public function get_image_file(){
		return $this->image_file;
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
	 * XML generation
	 */
	public function set_as_child_node($dom, &$parent_node){
		$node_image = $parent_node->appendChild($dom->createElement("image"));
		
		//Image ID
		$node_image_id = $node_image->appendChild($dom->createElement("imageId"));
		$node_image_id->appendChild($dom->createTextNode($this->image_id));
		
		//Display order
		$node_display_order = $node_image->appendChild($dom->createElement("displayOrder"));
		$node_display_order->appendChild($dom->createTextNode($this->display_order));
		
		//Image name
		$node_image_name = $node_image->appendChild($dom->createElement("imageName"));
		$node_image_name->appendChild($dom->createTextNode($this->image_name));
		
		//Valid period start date and time
		if(!empty($this->sta_dt)){
			$node_sta_dt = $node_image->appendChild($dom->createElement("staDt"));
			$node_sta_dt->appendChild($dom->createTextNode($this->sta_dt));
		}
		
		//Valid period end date and time
		if(!empty($this->end_dt)){
			$node_end_dt = $node_image->appendChild($dom->createElement("endDt"));
			$node_end_dt->appendChild($dom->createTextNode($this->end_dt));
		}
		
		//Image file
		if(!empty($this->image_file)){
			$node_image_file = $node_image->appendChild($dom->createElement("imageFile"));
			$this->image_file->set_as_child_node($dom, $node_image_file);
		}
		
		//Drawing area reference point X coordinate
		if(!is_null($this->x)){
			$node_x = $node_image->appendChild($dom->createElement("x"));
			$node_x->appendChild($dom->createTextNode($this->x));
		}
		
		//Drawing area reference point Y coordinate
		if(!is_null($this->y)){
			$node_y = $node_image->appendChild($dom->createElement("y"));
			$node_y->appendChild($dom->createTextNode($this->y));
		}
		
		//Drawing area width
		if(!is_null($this->width)){
			$node_width = $node_image->appendChild($dom->createElement("width"));
			$node_width->appendChild($dom->createTextNode($this->width));
		}
		
		//Drawing area height
		if(!is_null($this->height)){
			$node_height = $node_image->appendChild($dom->createElement("height"));
			$node_height->appendChild($dom->createTextNode($this->height));
		}
	}
}
?>