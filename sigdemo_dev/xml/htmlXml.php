<?php
class HtmlXml{
	private $htmlId;				//HTMLID
	private $devHtmlRelaDlLogId;	//Terminal program guide download ID
	private $waitServerSync;	//Distribution server synchronization wait flag
	private $origHash;			//Hash before encryption
	private $origFileSize;		//File size before encryption
	private $encHash;			//Encrypted hash
	private $encFileSize;		//Encrypted file size
	private $url1;				//URL1
	private $url2;				//URL2
	private $url3;				//URL3
	private $url4;				//URL4
	private $url5;				//URL5
	private $devLogDir;			//Device log storage location
	
	/**
	 * Accessor
	 */
	public function setHtmlId($htmlId){
		$this->htmlId = $htmlId;
	}
	public function getHtmlId(){
		return $this->htmlId;
	}
	public function setWaitServerSync($waitServerSync){
		$this->waitServerSync = $waitServerSync;
	}
	public function getWaitServerSync(){
		return $this->waitServerSync;
	}
	public function setDevHtmlRelaDlLogId($devHtmlRelaDlLogId){
		$this->devHtmlRelaDlLogId = $devHtmlRelaDlLogId;
	}
	public function getDevHtmlRelaDlLogId(){
		return $this->devHtmlRelaDlLogId;
	}
	public function setOrigHash($origHash){
		$this->origHash = $origHash;
	}
	public function getOrigHash(){
		return $this->origHash;
	}
	public function setOrigFileSize($origFileSize){
		$this->origFileSize = $origFileSize;
	}
	public function getOrigFileSize(){
		return $this->origFileSize;
	}
	public function setEncHash($encHash){
		$this->encHash = $encHash;
	}
	public function getEncHash(){
		return $this->encHash;
	}
	public function setEncFileSize($encFileSize){
		$this->encFileSize = $encFileSize;
	}
	public function getEncFileSize(){
		return $this->encFileSize;
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
	public function setDevLogDir($log_dir){
		$this->devLogDir = $log_dir;
	}
	public function getDevLogDir(){
		return $this->devLogDir;
	}
	
	/**
	 * XML text column generation
	 */
	public function getXml(){
		$dom = new DomDocument('1.0');
		$dom->encoding = "UTF-8";
		$dom->formatOutput = true;
		$this->setAsChildNode($dom, $dom);
		
		return $dom->saveXML();
	}
	
	/**
	 * XML generation
	 */
	public function setAsChildNode($dom, &$parentNode){
		$nodeHtml = $dom->appendChild($dom->createElement("html"));	//ルートノード
		if(!is_null($this->htmlId)){
			$nodeHtmlId = $nodeHtml->appendChild($dom->createElement("htmlId"));
			$nodeHtmlId->appendChild($dom->createTextNode($this->htmlId));
		}
		if(!is_null($this->devHtmlRelaDlLogId)){
			$nodeDevHtmlRelaDlLogId = $nodeHtml->appendChild($dom->createElement("devHtmlRelaDlLogId"));
			$nodeDevHtmlRelaDlLogId->appendChild($dom->createTextNode($this->devHtmlRelaDlLogId));
		}
		if(!is_null($this->waitServerSync)){
			$nodeWaitServerSync = $nodeHtml->appendChild($dom->createElement("waitServerSync"));
			$nodeWaitServerSync->appendChild($dom->createTextNode($this->waitServerSync));
		}
		if(!is_null($this->origHash)){
			$nodeOrigHash = $nodeHtml->appendChild($dom->createElement("origHash"));
			$nodeOrigHash->appendChild($dom->createTextNode($this->origHash));
		}
		if(!is_null($this->origFileSize)){
			$nodeOrigFileSize = $nodeHtml->appendChild($dom->createElement("origFileSize"));
			$nodeOrigFileSize->appendChild($dom->createTextNode($this->origFileSize));
		}
		if(!is_null($this->encHash)){
			$nodeEncHash = $nodeHtml->appendChild($dom->createElement("encHash"));
			$nodeEncHash->appendChild($dom->createTextNode($this->encHash));
		}
		if(!is_null($this->encFileSize)){
			$nodeEncFileSize = $nodeHtml->appendChild($dom->createElement("encFileSize"));
			$nodeEncFileSize->appendChild($dom->createTextNode($this->encFileSize));
		}
		if(!is_null($this->url1)){
			$nodeUrl1 = $nodeHtml->appendChild($dom->createElement("url1"));
			$nodeUrl1->appendChild($dom->createTextNode($this->url1));
		}
		if(!is_null($this->url2)){
			$nodeUrl2 = $nodeHtml->appendChild($dom->createElement("url2"));
			$nodeUrl2->appendChild($dom->createTextNode($this->url2));
		}
		if(!is_null($this->url3)){
			$nodeUrl3 = $nodeHtml->appendChild($dom->createElement("url3"));
			$nodeUrl3->appendChild($dom->createTextNode($this->url3));
		}
		if(!is_null($this->url4)){
			$nodeUrl4 = $nodeHtml->appendChild($dom->createElement("url4"));
			$nodeUrl4->appendChild($dom->createTextNode($this->url4));
		}
		if(!is_null($this->url5)){
			$nodeUrl5 = $nodeHtml->appendChild($dom->createElement("url5"));
			$nodeUrl5->appendChild($dom->createTextNode($this->url5));
		}
		if(!is_null($this->devLogDir)){
			$nodeDevLogDir = $nodeHtml->appendChild($dom->createElement("devLogDir"));
			$nodeDevLogDir->appendChild($dom->createTextNode($this->devLogDir));
		}
	}
}
?>