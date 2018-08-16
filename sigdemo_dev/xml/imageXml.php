<?php
require_once(dirname(__FILE__) . '/fileXml.php');

class ImageXml{
	private $imageId;		//Image ID
	private $displayOrder;	//Express
	private $imageName;		//Image name
	private $staDt;			//Valid period start date and time
	private $endDt;			//Valid period end date and time
	private $imageFile;		//Image file
	private $x;				//Drawing field reference point X coordinate
	private $y;				//Drawing field reference point Y coordinate
	private $width;			//Drawing area width
	private $height;		//Drawing area height
	
	/**
	 * constructor
	 */
	public function __construct($imageRow){
		$imageId = $imageRow["image_id"];
		$imageName = $imageRow["image_name"];
		$displayOrder = $imageRow["display_order"];
		$origHash = $imageRow["orig_hash"];
		$encHash = $imageRow["enc_hash"];
		$origFileDir = $imageRow["orig_file_dir"];
		$encFileDir = $imageRow["enc_file_dir"];
		$activeFileDir = $imageRow["active_file_dir"];
		$encFileSize = $imageRow["enc_file_size"];
		$origFileSize = $imageRow["orig_file_size"];
		$staDt = $imageRow["sta_dt"];
		$endDt = $imageRow["end_dt"];
		$fileName = $imageRow["file_name"];
		$origFileExte = $imageRow["orig_file_exte"];
		$encFileExte = $imageRow["enc_file_exte"];
		$x = $imageRow["x"];
		$y = $imageRow["y"];
		$width = $imageRow["width"];
		$height = $imageRow["height"];
		
		$this->setImageId($imageId);
		$this->setImageName($imageName);
		$this->setDisplayOrder($displayOrder);
		$this->setStaDt($staDt);
		$this->setEndDt($endDt);
		$this->setX($x);
		$this->setY($y);
		$this->setWidth($width);
		$this->setHeight($height);
		
		if(SERVER_SYNC_ENABLED_IMAGE === false){
			//When server synchronization is invalid, file set
			$imageFile = new fileXml();
			$imageFile->setOrigHash($origHash);
			if(ENCRYPT_ENABLED){
				$imageFile->setEncHash($encHash);
			}
			if(ENCRYPT_ENABLED){
				//$imageFile->setFileSize($encFileSize);
				$imageFile->setFileSize($origFileSize);
				$imageFile->setUrl1(DEFAULT_SERVER_ENC_URL . $encFileDir . $fileName . $encFileExte);
			} else {
				$imageFile->setFileSize($origFileSize);
				$imageFile->setUrl1(DEFAULT_SERVER_URL . $origFileDir . $fileName . $origFileExte);
			}
			$imageFile->setOrigFileSize($origFileSize);
			$this->setImageFile($imageFile);
		}
	}
	
	/**
	 * Accessor
	 */
	public function setImageId($imageId){
		$this->imageId = $imageId;
	}
	public function getImageId(){
		return $this->imageId;
	}
	public function setDisplayOrder($displayOrder){
		$this->displayOrder = $displayOrder;
	}
	public function getDisplayOrder(){
		return $this->displayOrder;
	}
	public function setImageName($imageName){
		$this->imageName = $imageName;
	}
	public function getImageName(){
		return $this->imageName;
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
	public function setImageFile($imageFile){
		$this->imageFile = $imageFile;
	}
	public function getImageFile(){
		return $this->imageFile;
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
		$nodeImage = $parentNode->appendChild($dom->createElement("image"));
		
		//Image ID
		$nodeImageId = $nodeImage->appendChild($dom->createElement("imageId"));
		$nodeImageId->appendChild($dom->createTextNode($this->imageId));
		
		//Express
		$nodeDisplayOrder = $nodeImage->appendChild($dom->createElement("displayOrder"));
		$nodeDisplayOrder->appendChild($dom->createTextNode($this->displayOrder));
		
		//Image name
		$nodeImageName = $nodeImage->appendChild($dom->createElement("imageName"));
		$nodeImageName->appendChild($dom->createTextNode($this->imageName));
		
		//Valid period start date and time
		if(!empty($this->staDt)){
			$nodeStaDt = $nodeImage->appendChild($dom->createElement("staDt"));
			$nodeStaDt->appendChild($dom->createTextNode($this->staDt));
		}
		
		//Valid period end date and time
		if(!empty($this->endDt)){
			$nodeEndDt = $nodeImage->appendChild($dom->createElement("endDt"));
			$nodeEndDt->appendChild($dom->createTextNode($this->endDt));
		}
		
		//Image file
		if(!empty($this->imageFile)){
			$nodeImageFile = $nodeImage->appendChild($dom->createElement("imageFile"));
			$this->imageFile->setAsChildNode($dom, $nodeImageFile);
		}
		
		//Drawing field reference point X coordinate
		if(!is_null($this->x)){
			$nodeX = $nodeImage->appendChild($dom->createElement("x"));
			$nodeX->appendChild($dom->createTextNode($this->x));
		}
		
		//Drawing field reference point Y coordinate
		if(!is_null($this->y)){
			$nodeY = $nodeImage->appendChild($dom->createElement("y"));
			$nodeY->appendChild($dom->createTextNode($this->y));
		}
		
		//Drawing area width
		if(!is_null($this->width)){
			$nodeWidth = $nodeImage->appendChild($dom->createElement("width"));
			$nodeWidth->appendChild($dom->createTextNode($this->width));
		}
		
		//Drawing area height
		if(!is_null($this->height)){
			$nodeHeight = $nodeImage->appendChild($dom->createElement("height"));
			$nodeHeight->appendChild($dom->createTextNode($this->height));
		}
	}
}
?>