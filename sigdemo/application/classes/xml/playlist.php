<?php
class Xml_Playlist{
	private $playlist_id;	//Playlist ID
	private $image_intvl;	//Image switching interval
	private $ch;			//CH
	private $arr_text;		//Text array
	private $arr_image;		//Image array
	private $arr_movie;		//Movie array
	
	/**
	 * constructor
	 */
	function __construct()
	{
		$this->arr_text = array();
		$this->arr_image = array();
		$this->arr_movie = array();
	}
	
	/**
	 * Accessor
	 */
	public function set_playlist_id($playlist_id){
		$this->playlist_id = $playlist_id;
	}
	public function get_playlist_id(){
		return $this->playlist_id;
	}
	public function set_image_intvl($image_intvl){
		$this->image_intvl = $image_intvl;
	}
	public function get_image_intvl(){
		return $this->image_intvl;
	}
	public function set_ch($ch){
		$this->ch = $ch;
	}
	public function get_ch(){
		return $this->ch;
	}
	public function set_arr_text($arr_text){
		$this->arr_text = $arr_text;
	}
	public function get_arr_text(){
		return $this->arr_text;
	}
	public function add_arr_text($text){
		array_push($this->arr_text, $text);
	}
	public function set_arr_image($arr_image){
		$this->arr_image = $arr_image;
	}
	public function get_arr_image(){
		return $this->arr_image;
	}
	public function add_arr_image($image){
		array_push($this->arr_image, $image);
	}
	public function set_arr_movie($arr_movie){
		$this->arr_movie = $arr_movie;
	}
	public function get_arr_movie(){
		return $this->arr_movie;
	}
	public function add_arr_movie($movie){
		array_push($this->arr_movie, $movie);
	}
	
	/**
	 * XML generation
	 */
	public function set_as_child_node($dom, &$parent_node){
		$node_playlist = $parent_node->appendChild($dom->createElement("playlist"));
		
		//CH
		$node_ch = $node_playlist->appendChild($dom->createElement("ch"));
		$node_ch->appendChild($dom->createTextNode($this->ch));
		
		//Playlist ID
		$node_playlist_id = $node_playlist->appendChild($dom->createElement("playlistId"));
		$node_playlist_id->appendChild($dom->createTextNode($this->playlist_id));
		
		//Image switching interval
		if(!empty($this->image_intvl)){
			$node_image_intvl = $node_playlist->appendChild($dom->createElement("imageIntvl"));
			$node_image_intvl->appendChild($dom->createTextNode($this->image_intvl));
		}
		
		//text
		if(!empty($this->arr_text)){
			$node_arr_text = $node_playlist->appendChild($dom->createElement("arrText"));
			foreach($this->arr_text as $text){
				$text->set_as_child_node($dom, $node_arr_text);
			}
		}
		
		//image
		if(!empty($this->arr_image)){
			$node_arr_image = $node_playlist->appendChild($dom->createElement("arrImage"));
			foreach($this->arr_image as $image){
				$image->set_as_child_node($dom, $node_arr_image);
			}
		}
		
		//Movie
		if(!empty($this->arr_movie)){
			$node_arr_movie = $node_playlist->appendChild($dom->createElement("arrMovie"));
			foreach($this->arr_movie as $movie){
				$movie->set_as_child_node($dom, $node_arr_movie);
			}
		}
	}
}
?>