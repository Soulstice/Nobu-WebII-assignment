<?php
class cartItem Extends DomainObject implements Serializable{

	static function getFieldNames() {
      return array('imageID', 'size', 'stock', 'frame', 'quantity', 'serial');
   }

	public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
	private $sizeCost = array("5x7" => 0.50,
								  "8x10" => 2.50,
								  "11x14" => 6.00,
								  "12x18" => 7.00
								);
	
	private $stockCost = array( 
								"Matte" => array( "5x7" => 0, "8x10" => 0, "11x14" => 0, "12x18" => 0),
								"Glossy" => array( "5x7" => 0.50, "8x10" => 0.50, "11x14" => 1.00, "12x18" => 1.00),
								"Canvas" => array( "5x7" => 4.00, "8x10" => 4.00, "11x14" => 8.00, "12x18" => 8.00)
								);			

	private $frameCost = array( 
								"none" => array( "5x7" => 0, "8x10" => 0, "11x14" => 0, "12x18" => 0),
								"Blond Maple" => array( "5x7" => 10.00, "8x10" => 12.00, "11x14" => 16.00, "12x18" => 20.00),
								"Expresso Walnut" => array( "5x7" => 10.00, "8x10" => 12.00, "11x14" => 16.00, "12x18" => 20.00),
								"Gold Accent" => array( "5x7" => 10.00, "8x10" => 12.00, "11x14" => 16.00, "12x18" => 20.00),
								"Silver Metal" => array( "5x7" => 10.00, "8x10" => 12.00, "11x14" => 16.00, "12x18" => 20.00)
								);														
	
	public function serialize() {
	return serialize(
		array("imageID" => $this->__get("imageID"),
				"size" => $this->__get("size"),
				"stock" => $this->__get("stock"),
				"frame" => $this->__get("frame"),
				"quantity" => $this->__get("quantity"),
				"serial" => $this->__get("serial")
			)
	);
	}
	
	public function unserialize($data) {
	$data = unserialize($data);	
	$this->__set("imageID",$data['imageID']);
	$this->__set("size",$data['size']);
	$this->__set("stock",$data['stock']);
	$this->__set("frame",$data['frame']);
	$this->__set("quantity",$data['quantity']);
	$this->__set("serial",$data['serial']);
	//$this->__set("cost",$data['cost']);
	
	}
	
	
	
	function calcCost() {
		$size1 = $this->sizeCost[$this->__get("size")]; 
		$stock1 = $this->stockCost[$this->__get("stock")][$this->__get("size")];
		$frame1 = $this->frameCost[$this->__get("frame")][$this->__get("size")];
		$quant = $this->__get("quantity");
		$cost = ($size1 + $stock1 + $frame1) * $quant;
		return $cost;	
	}


}

?>