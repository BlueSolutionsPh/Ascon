<?php
class DevProgDlXml{
	private $devProgDlLogId;	//Terminal program guide download ID
	private $waitServerSync;	//Distribution server synchronization wait flag
	private $devLogDir;			//Device log storage location
	private $arrProg;			//Program guide array
	private $devProgDlTime;		//Program guide download time
	
	/**
	 * constructor
	 */
	function __construct()
	{
		$this->arrProg = array();
	}
	
	/**
	 * Accessor
	 */
	public function setDevProgDlLogId($devProgDlLogId){
		$this->devProgDlLogId = $devProgDlLogId;
	}
	public function getDevProgDlLogId(){
		return $this->devProgDlLogId;
	}
	public function setWaitServerSync($waitServerSync){
		$this->waitServerSync = $waitServerSync;
	}
	public function getWaitServerSync(){
		return $this->waitServerSync;
	}
	public function setArrProg($arrProg){
		$this->arrProg = $arrProg;
	}
	public function setDevLogDir($log_dir){
		$this->devLogDir = $log_dir;
	}
	public function getDevLogDir(){
		return $this->devLogDir;
	}
	public function getArrProg(){
		return $this->arrProg;
	}
	public function addArrProg($prog){
		array_push($this->arrProg, $prog);
	}
	public function setStartTime($t){
		$this->startTime = $t;
	}
	public function getStartTime(){
		return $this->startTime;
	}
	public function setEndTime($t){
		$this->endTime = $t;
	}
	public function getEndTime(){
		return $this->endTime;
	}
	public function setDevProgDlTime($t){
		$this->devProgDlTime = $t;
	}
	public function getDevProgDlTime(){
		return $this->devProgDlTime;
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
	 * XML text column generation
	 */
	public function setAsChildNode($dom, &$parentNode){
		$nodeDevProgDl = $dom->appendChild($dom->createElement("devProgDl"));	//Route node
		
		//Terminal program guide download ID
		$nodeDevProgDlLogId = $nodeDevProgDl->appendChild($dom->createElement("devProgDlLogId"));
		$nodeDevProgDlLogId->appendChild($dom->createTextNode($this->devProgDlLogId));

		//Terminal program guide download time
		$nodeDevProgDlTime = $nodeDevProgDl->appendChild($dom->createElement("devProgDlTime"));
		$nodeDevProgDlTime->appendChild($dom->createTextNode($this->devProgDlTime));

		$nodeDevLogDir = $nodeDevProgDl->appendChild($dom->createElement("devLogDir"));
		$nodeDevLogDir->appendChild($dom->createTextNode($this->devLogDir));
		
		//Signage start end time
		$nodeStartTime = $nodeDevProgDl->appendChild($dom->createElement("startTime"));
		$nodeStartTime->appendChild($dom->createTextNode($this->startTime));
		$nodeEndTime = $nodeDevProgDl->appendChild($dom->createElement("endTime"));
		$nodeEndTime->appendChild($dom->createTextNode($this->endTime));
		
		//Communication restriction parameter
		$nodeDlOkStartTime = $nodeDevProgDl->appendChild($dom->createElement("dlOkStartTime"));
		$nodeDlOkStartTime->appendChild($dom->createTextNode(DL_OK_START_TIME));
		$nodeDlOkEndTime = $nodeDevProgDl->appendChild($dom->createElement("dlOkEndTime"));
		$nodeDlOkEndTime->appendChild($dom->createTextNode(DL_OK_END_TIME));
		$nodePollingInterval = $nodeDevProgDl->appendChild($dom->createElement("pollingInterval"));
		$nodePollingInterval->appendChild($dom->createTextNode(POLLING_INTERVAL));
		$nodeRandomMargin = $nodeDevProgDl->appendChild($dom->createElement("randomMargin"));
		$nodeRandomMargin->appendChild($dom->createTextNode(RANDOM_MARGIN));
		
		//Distribution server synchronization wait flag
		if(!is_null($this->waitServerSync)){
			$nodeWaitServerSync = $nodeDevProgDl->appendChild($dom->createElement("waitServerSync"));
			$nodeWaitServerSync->appendChild($dom->createTextNode($this->waitServerSync));
		}
		
		if(!empty($this->arrProg)){
			//With program guide setting
			$nodeArrProg = $nodeDevProgDl->appendChild($dom->createElement("arrProg"));
			foreach($this->arrProg as $prog){
				$prog->setAsChildNode($dom, $nodeArrProg);
			}
		} else {
			//No program guide setting
		}
	}
	
	/**
	 * Sec ⇔ "00: 00" mutual conversion
	 */
	public function toggle_time_format($time){
		if ( is_null($time) ) return null;
	
		if ( is_int($time) ) {
			$m = intval($time / 60);
			$s = $time - $m * 60;
			return sprintf('%02d:%02d', $m, $s);
		} else {
			list( $m, $s ) = explode(':', $time);
			return intval($m) * 60 + intval($s);
		}
	}
	
}
?>