<?php
class FileXml{
	private $origHash;	//Hash before encryption
	private $encHash;	//Hash after encryption
	private $fileSize;		//file size
	private $origFileSize;		//file size
	private $url1;			//URL1
	private $url2;			//URL2
	private $url3;			//URL3
	private $url4;			//URL4
	private $url5;			//URL5
	
	/**
	 * Accessor
	 */
	public function setOrigHash($origHash){
		$this->origHash = $origHash;
	}
	public function getOrigHash(){
		return $this->origHash;
	}
	public function setEncHash($encHash){
		$this->encHash = $encHash;
	}
	public function getEncHash(){
		return $this->encHash;
	}
	public function setFileSize($fileSize){
		$this->fileSize = $fileSize;
	}
	public function getFileSize(){
		return $this->fileSize;
	}
	public function setOrigFileSize($origFileSize){
		$this->origFileSize = $origFileSize;
	}
	public function getOrigFileSize(){
		return $this->origFileSize;
	}
	public function setUrl1($url1){
		$this->url1 = $url1;
	}
	public function getUrl1(){
		return $this->url1;
	}
	public function setUrl2($url2){
		$this->url2 = $url2;
	}
	public function getUrl2(){
		return $this->url2;
	}
	public function setUrl3($url3){
		$this->url3 = $url3;
	}
	public function getUrl3(){
		return $this->url3;
	}
	public function setUrl4($url4){
		$this->url4 = $url4;
	}
	public function getUrl4(){
		return $this->url4;
	}
	public function setUrl5($url5){
		$this->url5 = $url5;
	}
	public function getUrl5(){
		return $this->url5;
	}

	/**
	 * XML generation
	 */
	public function setAsChildNode($dom, &$parentNode){
		//Hash before encryption
		$nodeOrigHash = $parentNode->appendChild($dom->createElement("origHash"));
		$nodeOrigHash->appendChild($dom->createTextNode($this->origHash));
		
		//Hash after encryption
		if(!empty($this->encHash)){
			$nodeEncHash = $parentNode->appendChild($dom->createElement("encHash"));
			$nodeEncHash->appendChild($dom->createTextNode($this->encHash));
		}
		
		//file size
		$nodeFileSize = $parentNode->appendChild($dom->createElement("fileSize"));
		$nodeFileSize->appendChild($dom->createTextNode($this->fileSize));

		//Original file size
		$nodeOrigFileSize = $parentNode->appendChild($dom->createElement("origFileSize"));
		$nodeOrigFileSize->appendChild($dom->createTextNode($this->origFileSize));
		
		//URL1
		$nodeUrl1 = $parentNode->appendChild($dom->createElement("url1"));
		$nodeUrl1->appendChild($dom->createTextNode($this->url1));
		
		//URL2
		if(!empty($this->url2)){
			$nodeUrl2 = $parentNode->appendChild($dom->createElement("url2"));
			$nodeUrl2->appendChild($dom->createTextNode($this->url2));
		}
		
		//URL3
		if(!empty($this->url3)){
			$nodeUrl3 = $parentNode->appendChild($dom->createElement("url3"));
			$nodeUrl3->appendChild($dom->createTextNode($this->url3));
		}
		
		//URL4
		if(!empty($this->url4)){
			$nodeUrl4 = $parentNode->appendChild($dom->createElement("url4"));
			$nodeUrl4->appendChild($dom->createTextNode($this->url4));
		}
		
		//URL5
		if(!empty($this->url5)){
			$nodeUrl5 = $parentNode->appendChild($dom->createElement("url5"));
			$nodeUrl5->appendChild($dom->createTextNode($this->url5));
		}
	}
}
?>