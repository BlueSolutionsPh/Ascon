<?php
class ProgXml{
	private $progId;			//Program guide ID
	private $staDt;				//Distribution start date and time
	private $endDt;				//Delivery end date and time
	private $arrPlaylist;		//Playlist array
	private $progDlTime;		//Program guide download time
	
	/**
	 * constructor
	 */
	function __construct()
	{
		$this->arrPlaylist = array();
	}
	
	/**
	 * Accessor
	 */
	public function setProgId($progId){
		$this->progId = $progId;
	}
	public function getProgId(){
		return $this->progId;
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
	public function setArrPlaylist($arrPlaylist){
		$this->arrPlaylist = $arrPlaylist;
	}
	public function getArrPlaylist(){
		return $this->arrPlaylist;
	}
	public function addArrPlaylist($playlist){
		array_push($this->arrPlaylist, $playlist);
	}
	public function setProgDlTime($progDlTime){
		$this->progDlTime = $progDlTime;
	}
	public function getProgDlTime(){
		return $this->progDlTime;
	}
	
	/**
	 * XML generation
	 */
	public function setAsChildNode($dom, &$parentNode){
		$nodeProg = $parentNode->appendChild($dom->createElement("prog"));
		if(!is_null($this->progId)){
			//With program guide ID
			$nodeProgId = $nodeProg->appendChild($dom->createElement("progId"));
			$nodeProgId->appendChild($dom->createTextNode($this->progId));
			
			$nodeStaDt = $nodeProg->appendChild($dom->createElement("staDt"));
			$nodeStaDt->appendChild($dom->createTextNode($this->staDt));
			
			$nodeEndDt = $nodeProg->appendChild($dom->createElement("endDt"));
			$nodeEndDt->appendChild($dom->createTextNode($this->endDt));
			
			if(!empty($this->arrPlaylist)){
				//With playlist setting
				$nodeArrPlaylist = $nodeProg->appendChild($dom->createElement("arrPlaylist"));
				foreach($this->arrPlaylist as $playlist){
					$playlist->setAsChildNode($dom, $nodeArrPlaylist);
				}
			} else {
				//No playlist setting
			}
			
			//Group table DL moment
			$nodeProgDlTime = $nodeProg->appendChild($dom->createElement("progDlTime"));
			$nodeProgDlTime->appendChild($dom->createTextNode($this->progDlTime));
			
		} else {
			//No program guide
		}
	}
}
?>