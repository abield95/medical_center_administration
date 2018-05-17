<?php 

require_once('Entity.php');

/**
 * Place
 * @Definition: A bounded physical place or site, including any contained structures. 
 * @UsageNotes: Place may be natural or man-made. The geographic position of a place may or may not be constant. Places may be work facilities (where relevant acts occur), homes (where people live) or offices (where people work). Places may contain sub-places (floor, room, booth, bed). Places may also be sites that are investigated in the context of health care, social work, public health administration (e.g., buildings, picnic grounds, day care centers, prisons, counties, states, and other focuses of epidemiological events). 
 * Example: A field, lake, city, county, state, country, lot (land), building, pipeline, power line, playground, ship, truck 
 */
class Place extends Entity
{
	private $mobileInd;
	private $addr;
	private $directionsText;
	private $positionText;
	private $gpsText;//deprecated

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("PLC");

		$this->mobileInd = NULL;
		$this->addr = NULL;
		$this->directionsText = NULL;
		$this->positionText = NULL;
		$this->gpsText = NULL;//deprecated
	}


	/**
	 * @param $mobileInd An indication as to whether the facility has the capability to move freely from one location to another.
	 * Examples: Ships, aircraft and ambulances all have the capability to participate in healthcare acts.
	**/
	public function setMobileInd($mobileInd = FALSE)
	{
		$this->mobileInd = $mobileInd;
	}


	/**
	 * @param $addr The physical address of the place. 
	 * UsageConstraint: Must be the address that identifies the physical location of the place on a map.
	**/
	public function setAddr($addr)
	{
		$this->addr = $addr;
	}


	/**
	 * @param $directionsText A free text note that carries information related to a place that is useful for entities accessing that place.
	 * @UsageNotes: The attribute could include directions for finding the site when address information is inadequate, GPS information is not available, and/or the entity accessing the site cannot make direct use of the GPS information. It could also include information useful to people visiting the location 
	 * Example: Last house on the right; if owner not present, check whereabouts with neighbor down the road.
	**/
	public function setDirectionsText($directionsText)
	{
		$this->directionsText = $directionsText;
	}


	/**
	 * @param $positionText A set of codes that locates the site within a mapping scheme.
	 * Example: Map coordinates for US Geological Survey maps.
	**/
	public function setPositionText($positionText)
	{
		$this->positionText = $positionText;
	}
}

 ?>