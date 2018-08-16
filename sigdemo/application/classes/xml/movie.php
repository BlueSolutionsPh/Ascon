<?php
class Xml_Movie{
	private $movie_id;		//Movie ID
	private $display_order;	//Display order
	private $movie_name;	//Movie name
	private $movie_type;	//Movie type (1: movie + sound 2: sound only 3: Flash)
	private $sta_dt;		//Valid period start date and time
	private $end_dt;		//Valid period end date and time
	private $movie_file;	//Movie file
	private $sound_file;	//Audio file
	private $play_time;		//Playback time
	private $x;				//Drawing area reference point X coordinate
	private $y;				//Drawing area reference point Y coordinate
	private $width;			//Drawing area width
	private $height;		//Drawing area height
	
	/**
	 * constructor
	 */
	public function __construct($movie_row, $playlist_id, $login_acnt, $passwd, $request){
		$movie_id = $movie_row["movie_id"];
		$movie_name = $movie_row["movie_name"];
		$display_order = $movie_row["display_order"];
		$play_time = $movie_row["play_time"];
		$orig_file_dir = $movie_row["orig_file_dir"];
		if(ENCRYPT_ENABLED){
			$movie_file_size = $movie_row["movie_enc_file_size"];
			$sound_file_size = $movie_row["sound_enc_file_size"];
		} else {
			$movie_file_size = $movie_row["movie_orig_file_size"];
			$sound_file_size = $movie_row["sound_orig_file_size"];
		}
		$movie_orig_file_size = $movie_row["movie_orig_file_size"];
		$sound_orig_file_size = $movie_row["sound_orig_file_size"];
		$movie_orig_hash = $movie_row["movie_orig_hash"];
		$sound_orig_hash = $movie_row["sound_orig_hash"];
		$movie_orig_file_exte = $movie_row["movie_orig_file_exte"];
		$sound_orig_file_exte = $movie_row["sound_orig_file_exte"];
		$sta_dt = $movie_row["sta_dt"];
		$end_dt = $movie_row["end_dt"];
		$file_name = $movie_row["file_name"];
		$x = $movie_row["x"];
		$y = $movie_row["y"];
		$width = $movie_row["width"];
		$height = $movie_row["height"];
		if(!empty($movie_orig_file_exte)){
			$movie_file = new Xml_File();
			$movie_file->set_orig_hash($movie_orig_hash);
			$movie_file->set_file_size($movie_file_size);
			$movie_file->set_Orig_file_size($movie_orig_file_size);
			$movie_file->set_url_1(URL::base("https") . MODULE_NAME_PLAYLISTDL . "/index/" . $login_acnt . "/" . $passwd . "/" . $playlist_id . "/" . MOVIE_FILE_DIR . $file_name . $movie_orig_file_exte);
			$this->set_movie_file($movie_file);
		}
		if(!empty($sound_orig_file_exte)){
			$sound_file = new Xml_File();
			$sound_file->set_orig_hash($sound_orig_hash);
			$sound_file->set_file_size($sound_file_size);
			$sound_file->set_Orig_file_size($sound_orig_file_size);
			$sound_file->set_url_1(URL::base("https") . MODULE_NAME_PLAYLISTDL . "/index/" . $login_acnt . "/" . $passwd . "/" . $playlist_id . "/" . MOVIE_FILE_DIR . $file_name . $sound_orig_file_exte);
			$this->set_sound_file($sound_file);
		}
		$this->set_movie_id($movie_id);
		$this->set_movie_name($movie_name);
		$this->set_display_order($display_order);
		$this->set_sta_dt($sta_dt);
		$this->set_end_dt($end_dt);
		$this->set_play_time($play_time);
		$this->set_x($x);
		$this->set_y($y);
		$this->set_width($width);
		$this->set_height($height);
		if($movie_orig_file_exte === FILE_EXTE_SWF){
			//Flash
			$this->set_movie_type(MOVIE_TYPE_FLASH);
		} else if(!empty($sound_orig_file_exte) && empty($movie_orig_file_exte)){
			//Audio Only
			$this->set_movie_type(MOVIE_TYPE_SOUND_ONLY);
		} else {
			//Movie + sound
			$this->set_movie_type(MOVIE_TYPE_MOVIE_AND_SOUND);
		}
	}
	
	/**
	 * Accessor
	 */
	public function set_movie_id($movie_id){
		$this->movie_id = $movie_id;
	}
	public function get_movie_id(){
		return $this->movie_id;
	}
	public function set_display_order($display_order){
		$this->display_order = $display_order;
	}
	public function get_display_order(){
		return $this->display_order;
	}
	public function set_movie_name($movie_name){
		$this->movie_name = $movie_name;
	}
	public function get_movie_name(){
		return $this->movie_name;
	}
	public function set_movie_type($movie_type){
		$this->movie_type = $movie_type;
	}
	public function get_movie_type(){
		return $this->movie_type;
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
	public function set_movie_file($movie_file){
		$this->movie_file = $movie_file;
	}
	public function get_movie_file(){
		return $this->movie_file;
	}
	public function set_sound_file($sound_file){
		$this->sound_file = $sound_file;
	}
	public function get_sound_file(){
		return $this->sound_file;
	}
	public function set_play_time($play_time){
		$this->play_time = $play_time;
	}
	public function get_play_time(){
		return $this->play_time;
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
		$node_movie = $parent_node->appendChild($dom->createElement("movie"));
		
		//Movie ID
		$node_movie_id = $node_movie->appendChild($dom->createElement("movieId"));
		$node_movie_id->appendChild($dom->createTextNode($this->movie_id));
		
		//Display order
		$node_display_order = $node_movie->appendChild($dom->createElement("displayOrder"));
		$node_display_order->appendChild($dom->createTextNode($this->display_order));
		
		//Movie name
		$node_movie_name = $node_movie->appendChild($dom->createElement("movieName"));
		$node_movie_name->appendChild($dom->createTextNode($this->movie_name));
		
		//Movie type
		$node_movie_type = $node_movie->appendChild($dom->createElement("movieType"));
		$node_movie_type->appendChild($dom->createTextNode($this->movie_type));
		
		//Valid period start date and time
		if(!empty($this->sta_dt)){
			$node_sta_dt = $node_movie->appendChild($dom->createElement("staDt"));
			$node_sta_dt->appendChild($dom->createTextNode($this->sta_dt));
		}
		
		//Valid period end date and time
		if(!empty($this->end_dt)){
			$node_end_dt = $node_movie->appendChild($dom->createElement("endDt"));
			$node_end_dt->appendChild($dom->createTextNode($this->end_dt));
		}
		
		//Playback time (sec)
		$node_play_time = $node_movie->appendChild($dom->createElement("playTime"));
		$node_play_time->appendChild($dom->createTextNode($this->play_time));
		
		//Movie file
		if(!empty($this->movie_file)){
			$node_movie_file = $node_movie->appendChild($dom->createElement("movieFile"));
			$this->movie_file->set_as_child_node($dom, $node_movie_file);
		}
		
		//Audio file
		if(!empty($this->sound_file)){
			$node_sound_file = $node_movie->appendChild($dom->createElement("soundFile"));
			$this->sound_file->set_as_child_node($dom, $node_sound_file);
		}
		
		//Drawing area reference point X coordinate
		if(!is_null($this->x)){
			$node_x = $node_movie->appendChild($dom->createElement("x"));
			$node_x->appendChild($dom->createTextNode($this->x));
		}
		
		//Drawing area reference point Y coordinate
		if(!is_null($this->y)){
			$node_y = $node_movie->appendChild($dom->createElement("y"));
			$node_y->appendChild($dom->createTextNode($this->y));
		}
		
		//Drawing area width
		if(!is_null($this->width)){
			$node_width = $node_movie->appendChild($dom->createElement("width"));
			$node_width->appendChild($dom->createTextNode($this->width));
		}
		
		//Drawing area height
		if(!is_null($this->height)){
			$node_height = $node_movie->appendChild($dom->createElement("height"));
			$node_height->appendChild($dom->createTextNode($this->height));
		}
	}
}
?>