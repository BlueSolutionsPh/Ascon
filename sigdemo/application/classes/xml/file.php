<?php
class Xml_File{
	private $orig_hash;	//Hash before encryption
	private $enc_hash;	//Hash after encryption
	private $file_size;		//file size
	private $orig_file_size;	//file size
	private $url_1;			//URL1
	private $url_2;			//URL2
	private $url_3;			//URL3
	private $url_4;			//URL4
	private $url_5;			//URL5
	
	/**
	 * Accessor
	 */
	public function set_orig_hash($orig_hash){
		$this->orig_hash = $orig_hash;
	}
	public function get_orig_hash(){
		return $this->orig_hash;
	}
	public function set_encHash($enc_hash){
		$this->enc_hash = $enc_hash;
	}
	public function get_enc_hash(){
		return $this->enc_hash;
	}
	public function set_file_size($file_size){
		$this->file_size = $file_size;
	}
	public function get_file_size(){
		return $this->file_size;
	}
	public function set_orig_file_size($orig_file_size){
		$this->orig_file_size = $orig_file_size;
	}
	public function get_orig_file_size(){
		return $this->orig_file_size;
	}
	public function set_url_1($url_1){
		$this->url_1 = $url_1;
	}
	public function get_url_1(){
		return $this->url_1;
	}
	public function set_url_2($url_2){
		$this->url_2 = $url_2;
	}
	public function get_url_2(){
		return $this->url_2;
	}
	public function set_url_3($url_3){
		$this->url_3 = $url_3;
	}
	public function get_url_3(){
		return $this->url_3;
	}
	public function set_url_4($url_4){
		$this->url_4 = $url_4;
	}
	public function get_url_4(){
		return $this->url_4;
	}
	public function set_url_5($url_5){
		$this->url_5 = $url_5;
	}
	public function get_url_5(){
		return $this->url_5;
	}

	/**
	 * XML generation
	 */
	public function set_as_child_node($dom, &$parent_node){
		//Hash before encryption
		$node_orig_hash = $parent_node->appendChild($dom->createElement("origHash"));
		$node_orig_hash->appendChild($dom->createTextNode($this->orig_hash));
		
		//Hash after encryption
		if(!empty($this->enc_hash)){
			$node_enc_hash = $parent_node->appendChild($dom->createElement("encHash"));
			$node_enc_hash->appendChild($dom->createTextNode($this->enc_hash));
		}
		
		//file size
		$node_file_size = $parent_node->appendChild($dom->createElement("fileSize"));
		$node_file_size->appendChild($dom->createTextNode($this->file_size));
		
		//file size
		$node_file_size = $parent_node->appendChild($dom->createElement("origfileSize"));
		$node_file_size->appendChild($dom->createTextNode($this->orig_file_size));
		
		//URL1
		$node_url_1 = $parent_node->appendChild($dom->createElement("url1"));
		$node_url_1->appendChild($dom->createTextNode($this->url_1));
		
		//URL2
		if(!empty($this->url_2)){
			$node_url_2 = $parent_node->appendChild($dom->createElement("url2"));
			$node_url_2->appendChild($dom->createTextNode($this->url_2));
		}
		
		//URL3
		if(!empty($this->url_3)){
			$node_url_3 = $parent_node->appendChild($dom->createElement("url3"));
			$node_url_3->appendChild($dom->createTextNode($this->url_3));
		}
		
		//URL4
		if(!empty($this->url_4)){
			$node_url_4 = $parent_node->appendChild($dom->createElement("url4"));
			$node_url_4->appendChild($dom->createTextNode($this->url_4));
		}
		
		//URL5
		if(!empty($this->url_5)){
			$node_url_5 = $parent_node->appendChild($dom->createElement("url5"));
			$node_url_5->appendChild($dom->createTextNode($this->url_5));
		}
	}
}
?>