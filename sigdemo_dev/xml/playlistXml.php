<?php
class PlaylistXml{
	private $playlistId;	//Playlist ID
	private $playlistRelaId;//Playlist related ID
	private $randomFlg;		//Random play
	private $imageIntvl;	//Image switching interval
	private $ch;			//CH
	private $arrText;		//Text array
	private $arrImage;		//Image array
	private $arrMovie;		//Movie array
	
	/**
	 * constructor
	 */
	function __construct()
	{
		$this->arrText = array();
		$this->arrImage = array();
		$this->arrMovie = array();
	}
	
	/**
	 * Accessor
	 */
	public function setPlaylistId($playlistId){
		$this->playlistId = $playlistId;
	}
	public function setPlaylistRelaId($playlistRelaId){
		$this->playlistRelaId = $playlistRelaId;
	}
	public function getPlaylistId(){
		return $this->playlistId;
	}
	public function getplaylistRelaId(){
		return $this->playlistRelaId;
	}
	public function setRandomFlg($randomFlg){
		$this->randomFlg = $randomFlg;
	}
	public function getRandomFlg(){
		return $this->randomFlg;
	}
	public function setImageIntvl($imageIntvl){
		$this->imageIntvl = $imageIntvl;
	}
	public function getImageIntvl(){
		return $this->imageIntvl;
	}
	public function setCh($ch){
		$this->ch = $ch;
	}
	public function getCh(){
		return $this->ch;
	}
	public function setArrText($arrText){
		$this->arrText = $arrText;
	}
	public function getArrText(){
		return $this->arrText;
	}
	public function addArrText($text){
		array_push($this->arrText, $text);
	}
	public function setArrImage($arrImage){
		$this->arrImage = $arrImage;
	}
	public function getArrImage(){
		return $this->arrImage;
	}
	public function addArrImage($image){
		array_push($this->arrImage, $image);
	}
	public function setArrMovie($arrMovie){
		$this->arrMovie = $arrMovie;
	}
	public function getArrMovie(){
		return $this->arrMovie;
	}
	public function addArrMovie($movie){
		array_push($this->arrMovie, $movie);
	}
	
	/**
	 * XML generation
	 */
	public function setAsChildNode($dom, &$parentNode){
		$nodePlaylist = $parentNode->appendChild($dom->createElement("playlist"));
		//CH
		$nodeCh = $nodePlaylist->appendChild($dom->createElement("ch"));
		$nodeCh->appendChild($dom->createTextNode($this->ch));
		
		//Playlist ID
		$nodePlaylistId = $nodePlaylist->appendChild($dom->createElement("playlistRelaId"));
		$nodePlaylistId->appendChild($dom->createTextNode($this->playlistRelaId));
		
//		$nodePlaylistId = $nodePlaylist->appendChild($dom->createElement("playlistId"));
//		$nodePlaylistId->appendChild($dom->createTextNode($this->playlistId));
		
		//Random play
		if(!empty($this->randomFlg)){
			$nodeRandomFlg = $nodePlaylist->appendChild($dom->createElement("random"));
			$nodeRandomFlg->appendChild($dom->createTextNode($this->randomFlg));
		}
		
		//Image switching interval
		if(!empty($this->imageIntvl)){
			$nodeImageIntvl = $nodePlaylist->appendChild($dom->createElement("imageIntvl"));
			$nodeImageIntvl->appendChild($dom->createTextNode($this->imageIntvl));
		}
		
		//text
		if(!empty($this->arrText)){
			$nodeArrText = $nodePlaylist->appendChild($dom->createElement("arrText"));
			foreach($this->arrText as $text){
				$text->setAsChildNode($dom, $nodeArrText);
			}
		}
		
		//image
		if(!empty($this->arrImage)){
			$nodeArrImage = $nodePlaylist->appendChild($dom->createElement("arrImage"));
			foreach($this->arrImage as $image){
				$image->setAsChildNode($dom, $nodeArrImage);
			}
		}
		
		//Movie
		if(!empty($this->arrMovie)){
			$nodeArrMovie = $nodePlaylist->appendChild($dom->createElement("arrMovie"));
			foreach($this->arrMovie as $movie){
				$movie->setAsChildNode($dom, $nodeArrMovie);
			}
		}
	}
}
?>