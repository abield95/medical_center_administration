<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'Procedure.php';

/**
 * SubstanceAdministration
 * @Definition A type of procedure that involves a performer introducing or otherwise applying a material into or to the subject.
 * @UsageNotes  Substance administration is distinguished from an exposure by the participation of a performer in the act.
 The substance administered by a performer physically interacts with the subject or is otherwise "taken in" by the subject during the act of administration. 
 Detailed information about the supplied substance is represented using the entity class or one of its subtypes.
 The performer of a substance administration may be another entity such as a person, device, plant, e.g. poison ivy, animal, e.g. mosquito bite, or it may be the same entity as the subject, as in self-administration. 
 For purposes of this definition, photons and other models of radiation or light energy are considered substances.
 Substances may also include living entities such as live virus vaccines and other materials containing infectious agents, e.g. saliva, blood products, etc. (Note: if the infectious agent is the subject of the substance administration, then the infectious agent is modeled as a "Living Subject.") 
 In the intent moods, substance administration represents the plan to apply a given material. This includes (but is not limited to) prescriptions in which it might also be associated with a request for supply.  
 In event mood, substance administration represents a record of the actual application of a substance.
 * @Examples Substance administration may be used to represent
	 1) Administration of a measurable quantity of an external force (e.g. radiotherapy)
	 2) Administration of a measurable quantity of a substance or force as part of an investigative procedure (e.g. glucose administered in a glucose tolerance test). 
	 3) Chemotherapy regimens (multiple substance administrations)
	 4) Drug prescription
	 5) Vaccination record
	 6) Tube feeding of a patient
	 7) Agricultural field spraying
	 8) Oiling a machine
	 9) Medicating a herd in a feedlot via food additives
 */
class SubstanceAdministration extends Procedure
{
	private $routeCode;
	private $doseQuantity;
	private $rateQuantity;
	private $doseCheckQuantity;
	private $maxDoseQuantity;
	private $administrationUnitCode;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("SBADM");
		$this->routeCode = NULL;
		$this->doseQuantity = NULL;
		$this->rateQuantity = NULL;
		$this->doseCheckQuantity = NULL;
		$this->maxDoseQuantity = NULL;
		$this->administrationUnitCode = NULL;
	}


	/**
	 * @param $routeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/RouteOfAdministration.html
	 * @Definition The physiological path or route for introducing the therapeutic material into or onto the subject.
	 * @UsageConstraint Route, site of administration (administrationSiteCode), method of administration (methodCode) and the device used in administration are closely related. All four (if present) must be closely coordinated and in agreement. In some cases, the coding system used to specify one may pre-coordinate one or more of the others. 
	 * @UsageNotes If the route requires further specification, both the site of administration (administrationSiteCode) and the method of administration (methodCode) may be used. For example, if the routeCode is intravenous or intra-muscular, it may be necessary to specify the precise site, with approachSiteCode, (e.g., right forearm or left deltoid muscle respectively) and the precise method of administration, with methodCode, (e.g., slow bolus injection or Z-track injection, respectively). When the medication is delivered to an environmental site, or a location, the route code indicates a site on its form. 
	 * @Examples Oral, Rectal, Intra-venous.
	**/
	public function setRouteCode($routeCode)
	{
		$this->routeCode = array(
			'code' => $routeCode,
			'codeSystem' => "2.16.840.1.113883.5.112",
			'codeSystemName' => "RouteOfAdministration",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $doseQuantity datatype from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-PQ
	 * @Definition Specifies the amount of the player Entity of the "consumable" Participation's role that was or is to be given at one administration event. 
	 * @UsageConstraint Non-measurable, but countable units such as tablets and capsules must not be specified using the unit component of the PQ data type, except as an annotation, marked by {xxx}. 
	 * @UsageNotes The dose may be specified either as a physical quantity of active ingredient (e.g., 200 mg) or as the count of administration-units (e.g., tablets, capsules, "eaches"). Which approach is chosen depends upon the player of the 'consumable' participation (which identifies the drug being administered). If the consumable has a non-countable dosage form (e.g., measured in milligrams or litres), then the dose must be expressed in those units. If the consumable has a countable dosage form (tablets, capsules, "eaches"), then the dose must be expressed as a dimensionless count (i.e., with no other unit of measure specified). In circumstances where the administration is variable as "1 to 3 mg" the data type should be constrained to an uncertain range of PQ (URG<PQ>). 
	 * @DesignComments The constraint previously dictated that count units are not acceptable, before describing how to use them: that clause has been deleted. Question: is the constraint on the PQ data type (rather than attribute) appropriate here? 
	**/
	public function setDoseQuantity($doseQuantity)
	{
		$this->doseQuantity = $doseQuantity;
	}


	/**
	 * @param $rateQuantity The speed with which the substance is introduced into the subject, expressed as a physical (extensive) quantity over elapsed time. 
	 * @UsageNotes This is appropriate for continuously divisible dose forms (e.g., liquids, gases). If the rate may be anywhere in a range, the value should be specified as an uncertain range (URG<PQ>), and the rate should be anywhere in the specified range. 
	 * @Exampkes 100 mL/h, 1 g/d, 40mmol/h.
	**/
	public function setRateQuantity($rateQuantity)
	{
		$this->rateQuantity = $rateQuantity;
	}


	/**
	 * @param $doseCheckQuantity The ratio of a quantity of a substance that was or is intended to be administered over a period of time.
	 * @UsageNotes This attribute can be used in cases where the total dose over a period of time needs to be specified, without a need (or a possibility) to express the doseQuantity per administration. 
	 This can be used with different moodCodes, to either express the total dose that should be administered or the total dose that has been administered over a period of time. 
	 A common way to use this attribute is to specify a 'daily dose' (e.g. 3 units/day), in cases where the exact dosage regimen is unknown (or irrelevant), but the daily dose is still important for purposes of medication checking. 
	 In some countries, especially Japan, there is a regulatory requirement to note the total daily dose on the prescription and associated documentation. The purpose of this regulatory requirement is to encourage and facilitate reviewing the total dose prescribed to avoid over- (or under-) dosage. 
	 * @Examples With Erythromycin 250 mg 3 times a day, one can calculate the total daily dose as doseCheckQuantity = doseQuantity (250mg) * effectiveTime (3 /d) = 750 mg/1d. 
	 For an intravenous example, this term would be doseCheckQuantity = doseQuantity (100 ml) / rateQuantity (1 h) = 100ml/h, which can be calculated on a daily basis as doseCheckQuantity = 100ml/h * 24 h/d = 2400ml/d. The ingredient.quantity (5mg/L in this case) can be used to derive an answer in mg (12mg/d) if it is required. Such a value cannot be stored in doseCheckQuantity because the units would not be in agreement with those in doseQuantity and would break the formal constraint. 
	 * @UsageConstraint 
	 1) If both doseQuantity (amount per administration) and doseCheckQuantity (total amount per period) are specified, they need to be valued consistently, i.e. doseQuantity times number of administrations per day must equal doseCheckQuantity. 
	 2) Numerator must be in units comparable to doseQuantity (if both are specified) and denominator must be a measurement of time. 
	**/
	public function setDoseCheckQuantity($doseCheckQuantity)
	{
		$this->doseCheckQuantity = $doseCheckQuantity;
	}



	/**
	 * @param $maxDoseQuantity The maximum total quantity of a substance to be administered to a subject over the period of time.
	 * @UsageNotes This attribute is particularly useful where the allowed dosage is specified as a range or the timing is variable or PRN (as needed). It provides an overall limit on the quantity that may be administered in a period of time. Multiple occurrences of maxDoseQuantity may be used to indicate different limits over different time periods. 
	 * @DesignComments "Invariant" form of constraint has been removed. If this is to be the form of documenting a formal constraint, then the introduction needs to orient the reader, and all formal constraints require it. 
	 * @Examples 500 mg/day; 1200mg/week
	 * FormalConstraint Numerator must be in units comparable to doseQuantity and denominator must be a measurement of time.
	**/
	public function setMaxDoseQuantity($maxDoseQuantity)
	{
		$this->maxDoseQuantity = $maxDoseQuantity;
	}



	/**
	 * @param $administrationUnitCode A unit for the administered substance
	 * @UsageConstraint (1) This attribute SHOULD be used if and only if the material specified as the player of the Role attaching to the consumable participation is not in itself the finished dose form to be administered but a larger whole, pack, etc. 
	 (2) If the material so specified is the proper administered dose form, such as a tablet, capsule, etc. then this attribute SHOULD be valued NULL (not applicable). 
	 (3) If the material so specified is an amorphous substance (liquid, gas, powder, etc.) to be measured as a volume, mass, etc., then this attribute SHOULD remain NULL (not applicable). 
	 (4) If the material so specified is a container, and the content is to be measured as a volume, mass, etc., then this attribute SHOULD be specified as "measured portion". 
	 * @Rationale In the given example, without an administrationUnitCode, the doseQty = 1 would mean that the entire inhaler bottle is to be emptied upon a single administration event. The administrationUnitCode signifying "actuation" (or "puff") specifies that the doseQty relates to this fraction of the medication rather than to the whole.. 
	 * @Examples The ordering system only has a code for "Budesonide Metered Dose Inhaler" but the dose is to be measured in "number of actuations."
	**/
	public function setAdministrationUnitCode($administrationUnitCode)
	{
		$this->administrationUnitCode = $administrationUnitCode;
	}
}

 ?>