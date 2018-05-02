<?php 


/**
* ANY Type
class ANY
{
	private $dataType;
	private $nullFlavor;
	private $nonNull;
	private $isNull;
	private $notApplicable;
	private $unknown;
	private $other;
	function __construct()
	{
		$this->$dataType = new TYPE();
		$this->nullFlavor = new CS();
		$this->nonNull = new BN();
		$this->isNull = new BL();
		$this->notApplicable = new BL();
		$this->unknown = new BL();
		$this->other = new BL();
	}
}

/**
* TYPE
*/
class TYPE
{
	
	function __construct()
	{
		# code...
	}
}


 ?>