<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'Act.php';

/**
 * Observation
 * @Definition An act that is intended to result in new information about a subject.
 * @UsageNotes
 	 The main difference between Observations and other Acts is that Observations have a value attribute. The code attribute of Observation and the value attribute of Observation must be considered in combination to determine the semantics of the observation. 
	 Structurally, many observations are name-value-pairs, where the Observation.code (inherited from Act) is the name and the Observation.value is the value of the property. Such a construct is also known as a "variable" (a named feature that can assume a value); hence, the Observation class is always used to hold generic name-value-pairs or variables, even though the variable valuation may not be the result of an elaborate observation method. It may be a simple answer to a question or it may be an assertion or setting of a parameter. 
	 As with all Act statements, Observation statements describe what was done, and in the case of Observations, this includes a description of what was actually observed ("results" or "answers"); and those "results" or "answers" are part of the observation and not split off into other objects. 
	 The method of action is asserted by the Observation classCode or its subclasses at the least granular level, by the Observation.code attribute value at the medium level of granularity, and by the attribute value of observation.methodCode when a finer level of granularity is required. The method in whole or in part may also appear in the attribute value of Observation.value when using coded data types to express the value of the attribute. Relevant aspects of methodology may also be restated in value when the results themselves entail a methodology. 
	 An observation may consist of component observations each having their own Observation.code and Observation.value. In this case, the composite observation may not have an Observation.value for itself. For instance, a white blood cell count consists of the sub-observations for the counts of the various granulocytes, lymphocytes and other normal or abnormal blood cells (e.g., blasts). The overall white blood cell count Observation itself may therefore not have a value by itself (even though it could have one, e.g., the sum total of white blood cells). Thus, as long as an Act is essentially an Act of recognizing and noting information about a subject, it is an Observation, regardless of whether it has a simple value by itself or whether it has sub-observations. 
	 Even though observations are professional acts (see Act) and as such are intentional actions, this does not require that every possible outcome of an observation be pondered in advance of it being actually made. For instance, differential white blood cell counts (WBC) rarely show blasts, but if they do, this is part of the WBC observation even though blasts might not be predefined in the structure of a normal WBC. 
	 Clinical documents commonly have 'Subjective' and 'Objective' findings, both of which are kinds of Observations. In addition, clinical documents commonly contain 'Assessments,' which are also kinds of Observations. Thus, the establishment of a diagnosis is an Observation. 
 * @DesignComments The usage notes need to address observations that do not follow the name-value semantic paradigm, e.g., those identifying pathologies. 
 * @Examples
	 1) Recording the results of a Family History Assessment 
	 2) Laboratory test and associated result 
	 3) Physical exam test and associated result 
	 4) Device temperature 
	 5) Soil lead level 
	 6) An assertion of a clinical finding, such as left femur fracture 
 */
class Observation extends Act
{
	private $value;
	private $valueNegationInd;
	private $interpretationCode;
	private $methodCode;
	private $targetSiteCode;
	//Specializations DiagnosticImage, PublicHealthCase

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("OBS");
		$this->value = NULL;
		$this->valueNegationInd = false;
		$this->interpretationCode = NULL;
		$this->methodCode = NULL;
		$this->targetSiteCode = NULL;
	}


	/**
	 * @param $value from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ObservationValue.html
	 * @Definition The result of the observation action.
	 * @UsageConstraint This attribute SHALL NOT be present if the containing observation has any outbound ActRelationships with a typeCode of "VALUE". 
	 * @UsageNotes
		The appropriate data type of the Observation.value varies with the kind of Observation and can generally be described in Observation definitions or in a simple relation that pairs Act.codes to value data types. 
		The following guidelines govern the choice of the appropriate value data type.
		(1) Quantitative measurements use the data type Physical Quantity (PQ) in general. A PQ is essentially a real number with a unit. This is the general preference for all numeric values, subject to a few exceptions listed below. 
		Numeric values MUST NOT be communicated as character strings (ST).
		(2) Titer (e.g., 1:64) and very few other ratios use the data type Ratio (RTO). For titers, the ratio would be a ratio of two integer numbers (e.g., 1:128). Other ratios may relate different quantitative data types, such as a "price" specified in Physical Quantity over Monetary Amount. 
		Sometimes by local conventions titers are reported as just the denominator (e.g., 32 instead of 1/32). Such conventions are confusing and SHOULD be converted into correct ratios in HL7 messages. 
		(3) Index values (a number without unit) uses the Real Number (REAL) data type. When a quantity does not have a proper unit, one can just send the number as a real number. Alternatively one can use a PQ with a dimensionless unit (e.g., 1 or %). An integer number should only be sent when the measurement is by definition an integer, which is an extremely rare case and then is most likely an ordinal (see below). 
		(4) Ranges (e.g., <3; 12-20) must be expressed as Interval of Physical Quantity (IVL<PQ>) or intervals of other quantity data types. 
		Sometimes, such intervals are used to report the uncertainty of measurement value. For uncertainty, there are dedicated data type extensions available. 
		(5) Ordinals (e.g., +, ++, +++; or I, IIa, IIb, III, IV) use the Coded Ordinal (CO) data type.
		(6) Nominal results ("taxons," e.g., organism type) use any of the coded data types (CD, CE) that specify at least a code and a coding system, and optionally original text, translations to other coding systems, and qualifiers. 
		(7) Imaging results use the Encapsulated Data (ED) type. The encapsulated data type allows one to send an image (e.g., chest X-ray) or a movie (e.g., coronary angiography, cardiac echo) as alternatively inline binary data or as a reference to an external address where the data can be downloaded on demand. . 
		(8) Waveforms can be sent using the Correlated Observation Sequences templates that provide all the data in an HL7 framework. In addition one can use the Encapsulated Data (ED) data type to send waveforms in other than HL7 formats or to refer to waveform data for on-demand download. 
		(9) The character string data type may exceptionally be used to convey formalized expressions that do not fit in any of the existing data types. However, the string data type SHALL NOT be used if the meaning can be represented by one of the existing data types. 
		(10) Timestamps SHOULD NOT be sent in Observations if there are more appropriate places to send them, e.g., usually as Act.effectiveTime of some act. (E.g., "specimen received in lab" is in the effectiveTime of an Act describing the specimen transport to the lab, not in an Observation. . 
		(11) Sets of values of any data type, enumerated sets as well as intervals, are often used for Observation criteria (event-criterion mood) to specify "normal ranges" or "decision ranges" (for alerts). 
		(12) For sequences of observations (repeated measurements of the same property during a relatively short time) a Sequence (LIST) data type is used. Refer to the Correlated Observation Sequences specification for more detail. 
		(13) Uncertainty of values is specified using the Probability and Probability Distribution data type extensions (UVP, PPD). If a statistical sample is reported with absolute frequencies of categories a Bag collection (BAG) can be used efficiently. 
	**/
	public function setValue($value)
	{
		$this->value = array(
			'code' => $value,
			'codeSystem' => "2.16.840.1.113883.5.1063",
			'codeSystemName' => "ObservationValue",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $valueNegationInd Indicates that when the observation event occurred, the finding communicated by the value attribute was NOT found. 
	 * @UsageNotes This attribute should only be used when the terminology used for Observation.value is not itself capable of expressing negated findings. (E.g. ICD9).
	**/
	public function setValueNegationInd($valueNegationInd = false)
	{
		$this->valueNegationInd = $valueNegationInd;
	}


	/**
	 * @param $interpretationCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ObservationInterpretation.html
	 * @Definition A qualitative interpretation of the observation.
	 * @UsageNotes These interpretation codes are sometimes called "abnormal flags," however, the judgment of normalcy is just one of the interpretations, and is often not relevant. For example, the susceptibility interpretations are not about "normalcy," and for any observation of a pathologic condition, it does not make sense to state the normalcy, since pathologic conditions are never considered "normal." 
	 * @Examples Normal, abnormal, below normal, change up, resistant.
	**/
	public function setInterpretationCode($interpretationCode)
	{
		$this->interpretationCode = array(
			'code' => $interpretationCode,
			'codeSystem' => "2.16.840.1.113883.5.83",
			'codeSystemName' => "ObservationInterpretation",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $methodCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ObservationMethod.html
	 * @Definition The means or technique used to ascertain the observation.
	 * @UsageConstraint In all observations the method is already partially specified by the Act.code. In this case, the methodCode NEED NOT be used at all. The methodCode MAY still be used to identify this method more clearly in addition to what is implied from the Act.code. However, an information consumer system or process SHOULD NOT depend on this methodCode information for method detail that is implied by the Act.code. 
	 The methodCode SHOULD NOT be used to identify the specific device or test-kit material used in the observation
	 * @UsageNotes In all observations the method is already partially specified by simply knowing the kind of observation (Observation.code) and this implicit information about the method does not need to be specified in Observation.methodCode. For example, if Observation.code uses a LOINC code, the method may already be known to a significant degree of precision: many LOINC codes are defined for specific methods when the method makes a practical difference in interpretation. Thus, using LOINC, the difference between susceptibility studies using the minimal inhibitory concentration (MIC) or the agar diffusion method (Kirby-Baur) are specifically assigned different codes. The methodCode therefore is only an additional qualifier to specify what may not be known already from the Act.code. 
	 Some variances in methods may be tied to the particular device used. The methodCode should not be used to identify the specific device or test-kit material used in the observation. Such information about devices or test-kits should be associated with the observation as device participations 
	 * @Examples Blood pressure measurement method: arterial puncture vs. sphygmomanometer (Riva-Rocci), sitting vs. supine position
	**/
	public function setMethodCode($methodCode)
	{
		$this->methodCode = array(
			'code' => $methodCode,
			'codeSystem' => "2.16.840.1.113883.5.84",
			'codeSystemName' => "ObservationMethod",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $targetSiteCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActSite.html
	 * @Definition The anatomical site or system that is the focus of the observation.
	 * @UsageNotes Most observation target sites are implied by the observation definition and Act.code, or Observation.value. For example, "heart murmur" always has the heart as target. This attribute is used only when the observation target site needs to be refined, to distinguish right from left, etc. If the subject of the Observation is something other than a human patient or animal, the attribute is used analogously to specify a structural landmark of the thing where the act focuses. For example, if the subject is a lake, the site could be inflow and outflow, etc. If the subject is a lymphatic node, "hilus," "periphery," or other node sites would be valid target sites.
	 * @Examples Heart, hilus of a lymphatic node, lake inflow
	 * @FormalConstraint The targetSiteCode value, if specified, SHALL NOT conflict with what is implied about the target site or system from the observation definition and the Act.code. 
	**/
	public function setTargetSiteCode($targetSiteCode)
	{
		$this->targetSiteCode = array(
			'code' => $targetSiteCode,
			'codeSystem' => "2.16.840.1.113883.5.1052",
			'codeSystemName' => "ActSite",
			'codeSystemVersion' => "1"
		);
	}
}

 ?>