<?php
require_once(dirname(__FILE__) . '/fileXml.php');

class MovieXml{
	private $movieId;		//Movie ID
	private $displayOrder;	//Express
	private $movieName;		//Movie name
	private $movieType;		//Movie type (1: movie + sound 2: sound only 3: Flash)
	private $staDt;			//Valid period start date and time
	private $endDt;			//Valid period end date and time
	private $movieFile;		//Movie file
	private $soundFile;		//Audio file
	private $playTime;		//Playback time
	private $x;				//Drawing field reference point X coordinate
	private $y;				//Drawing field reference point Y coordinate
	private $width;			//Drawing area width
	private $height;		//Drawing area height
	
	/**
	 * constructor
	 */
	public function __construct($movieRow){
		$movieId = $movieRow["movie_id"];
		$movieName = $movieRow["movie_name"];
		$displayOrder = $movieRow["display_order"];
		$playTime = $movieRow["play_time"];
		$origFileDir = $movieRow["orig_file_dir"];
		$encFileDir = $movieRow["enc_file_dir"];
		$activeFileDir = $movieRow["active_file_dir"];
		$movieOrigFileSize = $movieRow["movie_orig_file_size"];
		$soundOrigFileSize = $movieRow["sound_orig_file_size"];
		$movieEncFileSize = $movieRow["movie_enc_file_size"];
		$soundEncFileSize = $movieRow["sound_enc_file_size"];
		$movieOrigHash = $movieRow["movie_orig_hash"];
		$soundOrigHash = $movieRow["sound_orig_hash"];
		$movieEncHash = $movieRow["movie_enc_hash"];
		$soundEncHash = $movieRow["sound_enc_hash"];
		$movieOrigFileExte = $movieRow["movie_orig_file_exte"];
		$soundOrigFileExte = $movieRow["sound_orig_file_exte"];
		$movieEncFileExte = $movieRow["movie_enc_file_exte"];
		$soundEncFileExte = $movieRow["sound_enc_file_exte"];
		$staDt = $movieRow["sta_dt"];
		$endDt = $movieRow["end_dt"];
		$fileName = $movieRow["file_name"];
		$x = $movieRow["x"];
		$y = $movieRow["y"];
		$width = $movieRow["width"];
		$height = $movieRow["height"];
		
		$this->setMovieId($movieId);
		$this->setMovieName($movieName);
		$this->setDisplayOrder($displayOrder);
		$this->setStaDt($staDt);
		$this->setEndDt($endDt);
		$this->setPlayTime($playTime);
		$this->setX($x);
		$this->setY($y);
		$this->setWidth($width);
		$this->setHeight($height);
		
		if(SERVER_SYNC_ENABLED_MOVIE === false){
			//When server synchronization is invalid, file set
			if(!empty($movieOrigFileExte)){
				$movieFile = new fileXml();
				$movieFile->setOrigHash($movieOrigHash);
				if(ENCRYPT_ENABLED){
					$movieFile->setEncHash($movieEncHash);
					$movieFile->setFileSize($movieEncFileSize);
					$movieFile->setUrl1(DEFAULT_SERVER_ENC_URL . $encFileDir . $fileName . $movieEncFileExte);
				} else {
					$movieFile->setFileSize($movieOrigFileSize);
					$movieFile->setUrl1(DEFAULT_SERVER_URL . $origFileDir . $fileName . $movieOrigFileExte);
				}
				$movieFile->setOrigFileSize($movieOrigFileSize);
				$this->setMovieFile($movieFile);
			}
			if(!empty($soundOrigFileExte)){
				$soundFile = new fileXml();
				$soundFile->setOrigHash($soundOrigHash);
				if(ENCRYPT_ENABLED){
					$soundFile->setEncHash($soundEncHash);
					$soundFile->setFileSize($soundEncFileSize);
					$soundFile->setUrl1(DEFAULT_SERVER_ENC_URL . $encFileDir . $fileName . $soundEncFileExte);
				} else {
					$soundFile->setFileSize($soundOrigFileSize);
					$soundFile->setUrl1(DEFAULT_SERVER_URL . $origFileDir . $fileName . $soundOrigFileExte);
				}
				$soundFile->setOrigFileSize($soundOrigFileSize);
				$this->setSoundFile($soundFile);
			}
			if($movieOrigFileExte === FILE_EXTE_SWF){
				//Flash
				$this->setMovieType(MOVIE_TYPE_FLASH);
			} else if(!empty($soundOrigFileExte) && empty($movieOrigFileExte)){
				//Audio Only
				$this->setMovieType(MOVIE_TYPE_SOUND_ONLY);
			} else {
				//Movie + sound
				$this->setMovieType(MOVIE_TYPE_MOVIE_AND_SOUND);
			}
		}
	}
	
	/**
	 * Accessor
	 */
	public function setMovieId($movieId){
		$this->movieId = $movieId;
	}
	public function getMovieId(){
		return $this->movieId;
	}
	public function setDisplayOrder($displayOrder){
		$this->displayOrder = $displayOrder;
	}
	public function getDisplayOrder(){
		return $this->displayOrder;
	}
	public function setMovieName($movieName){
		$this->movieName = $movieName;
	}
	public function getMovieName(){
		return $this->movieName;
	}
	public function setMovieType($movieType){
		$this->movieType = $movieType;
	}
	public function getMovieType(){
		return $this->movieType;
	}
	public function setStaDt($staDt){
		$this->staDt = $staDt;
	}
	public function getStaDt(){
		return $this->staDt;
	}
	public function setEndDt($endDt){
		$this->endDt = $endDt;
	}
	public function getEndDt(){
		return $this->endDt;
	}
	public function setMovieFile($movieFile){
		$this->movieFile = $movieFile;
	}
	public function getMovieFile(){
		return $this->movieFile;
	}
	public function setSoundFile($soundFile){
		$this->soundFile = $soundFile;
	}
	public function getSoundFile(){
		return $this->soundFile;
	}
	public function setPlayTime($playTime){
		$this->playTime = $playTime;
	}
	public function getPlayTime(){
		return $this->playTime;
	}
	public function setX($x){
		$this->x = $x;
	}
	public function getX(){
		return $this->x;
	}
	public function setY($y){
		$this->y = $y;
	}
	public function getY(){
		return $this->y;
	}
	public function setWidth($width){
		$this->width = $width;
	}
	public function getWidth(){
		return $this->width;
	}
	public function setHeight($height){
		$this->height = $height;
	}
	public function getHeight(){
		return $this->height;
	}
	
	/**
	 * XML generation
	 */
	public function setAsChildNode($dom, &$parentNode){
		$nodeMovie = $parentNode->appendChild($dom->createElement("movie"));
		
		//Movie ID
		$nodeMovieId = $nodeMovie->appendChild($dom->createElement("movieId"));
		$nodeMovieId->appendChild($dom->createTextNode($this->movieId));
		
		//Express
		$nodeDisplayOrder = $nodeMovie->appendChild($dom->createElement("displayOrder"));
		$nodeDisplayOrder->appendChild($dom->createTextNode($this->displayOrder));
		
		//Movie name
		$nodeMovieName = $nodeMovie->appendChild($dom->createElement("movieName"));
		$nodeMovieName->appendChild($dom->createTextNode($this->movieName));
		
		//Movie type
		$nodeMovieType = $nodeMovie->appendChild($dom->createElement("movieType"));
		$nodeMovieType->appendChild($dom->createTextNode($this->movieType));
		
		//Valid period start date and time
		if(!empty($this->staDt)){
			$nodeStaDt = $nodeMovie->appendChild($dom->createElement("staDt"));
			$nodeStaDt->appendChild($dom->createTextNode($this->staDt));
		}
		
		//Valid period end date and time
		if(!empty($this->endDt)){
			$nodeEndDt = $nodeMovie->appendChild($dom->createElement("endDt"));
			$nodeEndDt->appendChild($dom->createTextNode($this->endDt));
		}
		
		//Playback time (sec)
		$nodePlayTime = $nodeMovie->appendChild($dom->createElement("playTime"));
		$nodePlayTime->appendChild($dom->createTextNode($this->playTime));
		
		//Movie file
		if(!empty($this->movieFile)){
			$nodeMovieFile = $nodeMovie->appendChild($dom->createElement("movieFile"));
			$this->movieFile->setAsChildNode($dom, $nodeMovieFile);
		}
		
		//Audio file
		if(!empty($this->soundFile)){
			$nodeSoundFile = $nodeMovie->appendChild($dom->createElement("soundFile"));
			$this->soundFile->setAsChildNode($dom, $nodeSoundFile);
		}
		
		//Drawing field reference point X coordinate
		if(!is_null($this->x)){
			$nodeX = $nodeMovie->appendChild($dom->createElement("x"));
			$nodeX->appendChild($dom->createTextNode($this->x));
		}
		
		//Drawing field reference point Y coordinate
		if(!is_null($this->y)){
			$nodeY = $nodeMovie->appendChild($dom->createElement("y"));
			$nodeY->appendChild($dom->createTextNode($this->y));
		}
		
		//Drawing area width
		if(!is_null($this->width)){
			$nodeWidth = $nodeMovie->appendChild($dom->createElement("width"));
			$nodeWidth->appendChild($dom->createTextNode($this->width));
		}
		
		//Drawing area height
		if(!is_null($this->height)){
			$nodeHeight = $nodeMovie->appendChild($dom->createElement("height"));
			$nodeHeight->appendChild($dom->createTextNode($this->height));
		}
	}
}
?>