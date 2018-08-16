<?php
class TextXml{
	private $textId;		//Text ID
	private $displayOrder;	//Express
	private $textName;		//Text name
	private $textMsg;		//Text message
	private $staDt;			//Valid period start date and time
	private $endDt;			//Valid period end date and time
	private $x;				//Drawing field reference point X coordinate
	private $y;				//Drawing field reference point Y coordinate
	private $width;			//Drawing area width
	private $height;		//Drawing area height
	
	/**
	 * constructor
	 */
	public function __construct($textRow){
		$textId = $textRow["text_id"];
		$textName = $textRow["text_name"];
		$textMsg = $textRow["text_msg"];
		$displayOrder = $textRow["display_order"];
		$staDt = $textRow["sta_dt"];
		$endDt = $textRow["end_dt"];
		$x = $textRow["x"];
		$y = $textRow["y"];
		$width = $textRow["width"];
		$height = $textRow["height"];
		
		$this->setTextId($textId);
		$this->setTextName($textName);
		$this->setTextMsg($textMsg);
		$this->setDisplayOrder($displayOrder);
		$this->setStaDt($staDt);
		$this->setEndDt($endDt);
		$this->setX($x);
		$this->setY($y);
		$this->setWidth($width);
		$this->setHeight($height);
	}
	
	/**
	 * Accessor
	 */
	public function setTextId($textId){
		$this->textId = $textId;
	}
	public function getTextId(){
		return $this->textId;
	}
	public function setDisplayOrder($displayOrder){
		$this->displayOrder = $displayOrder;
	}
	public function getDisplayOrder(){
		return $this->displayOrder;
	}
	public function setTextName($textName){
		$this->textName = $textName;
	}
	public function getTextName(){
		return $this->textName;
	}
	public function setTextMsg($textMsg){
		$this->textMsg = $textMsg;
	}
	public function getTextMsg(){
		return $this->textMsg;
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
		$nodeText = $parentNode->appendChild($dom->createElement("text"));
		
		//Text ID
		$nodeTextId = $nodeText->appendChild($dom->createElement("textId"));
		$nodeTextId->appendChild($dom->createTextNode($this->textId));
		
		//Express
		$nodeDisplayOrder = $nodeText->appendChild($dom->createElement("displayOrder"));
		$nodeDisplayOrder->appendChild($dom->createTextNode($this->displayOrder));
		
		//Text name
		$nodeTextName = $nodeText->appendChild($dom->createElement("textName"));
		$nodeTextName->appendChild($dom->createTextNode($this->textName));
		
		//Text message
		$nodeTextMsg = $nodeText->appendChild($dom->createElement("textMsg"));
		$nodeTextMsg->appendChild($dom->createTextNode($this->textMsg));
		
		//Valid period start date and time
		if(!empty($this->staDt)){
			$nodeStaDt = $nodeText->appendChild($dom->createElement("staDt"));
			$nodeStaDt->appendChild($dom->createTextNode($this->staDt));
		}
		
		//Valid period end date and time
		if(!empty($this->endDt)){
			$nodeEndDt = $nodeText->appendChild($dom->createElement("endDt"));
			$nodeEndDt->appendChild($dom->createTextNode($this->endDt));
		}
		
		//Drawing field reference point X coordinate
		if(!is_null($this->x)){
			$nodeX = $nodeText->appendChild($dom->createElement("x"));
			$nodeX->appendChild($dom->createTextNode($this->x));
		}
		
		//Drawing field reference point Y coordinate
		if(!is_null($this->y)){
			$nodeY = $nodeText->appendChild($dom->createElement("y"));
			$nodeY->appendChild($dom->createTextNode($this->y));
		}
		
		//Drawing area width
		if(!is_null($this->width)){
			$nodeWidth = $nodeText->appendChild($dom->createElement("width"));
			$nodeWidth->appendChild($dom->createTextNode($this->width));
		}
		
		//Drawing area height
		if(!is_null($this->height)){
			$nodeHeight = $nodeText->appendChild($dom->createElement("height"));
			$nodeHeight->appendChild($dom->createTextNode($this->height));
		}
	}
}
?>