<?php 

/**
 * IdentifiedPerson
 * From file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/domains/uvpa/editable/PRPA_HD101301UV-NoEdit.html#AdministrativeObservation
 */
class IdentifiedPerson extends CommunicationInfrastructure\CoreInfrastructure\Role
{
	private $person;
	private $assigningOrganization;
	private $subjectOf;//(0..*)
	function __construct()
	{
		$this->setClassCode("IDENT");
		$this->setStatusCode("active");
		$this->person = new Person();

		/**
		 * A subtype of LivingSubject representing a human being
		 * @var array contain the main human and some dependencies
		 * @var 'person' => A subtype of LivingSubject representing a human being 
		 * @var  'asPatientOfOtherProvider' => An association of the focal living subject to a role of a patient who is the subject of a care provision act. The care provision performer may be the primary provider responsible for general care or within a specific healthcare facility. This relationship is usually solid over time and is recorded only for administrative purposes; actual care provided by the healthcare provider is recorded elsewhere. 
		 * @var  'asEmployee' => A relationship of the focal person with an organization to receive wages or salary. The purpose of this class is to identify the type of relationship the employee has to the employer rather than the nature of the work actually performed. 
		 * @var  'asCitizen' => A formal relationship between the focal person (player) who owes loyalty to and is entitled by birth or naturalization to the protection of a nation (scoper) 
		 * @var  'asStudent' => An enrollment of the focal person as a student of a school 
		 * @var  'asMember' => A membership of the playing living subject in a group such as family, tribe, or religious organization---->UsageNotes: MEMBER Changed effectiveTime from IVL<TS> to GTS to allow conveying that a person is an active member of a household on a particular schedule (e.g., alternate weeks). 
		 * @var  'asOtherIDs' => An identifying relationship between the focal living subject and a scoping organization. Note that this could be an identifier used by the primary scoping organization in a different context.
		 * @var  'contactParty' A person or an organization (playing entity) that is authorized to provide or receive information about the focal person (scoping entity) 
		 * @var  'guardian' => A person or organization (playing entity) that is legally responsible for the care and management of the focal person (scoping entity) 
		 * @var  'personalRelationship' =>  A personal relationship between the focal living subject and another living subject 
		 * @var  'birthPlace' => The birthplace of the focal living subject 
		 * @var  'languajeCommunication' => A language communication capability of the focal person -->ya lo tiene person
		 */
		$this->person = array(
			'person' => new Person("INSTANCE"),
			'asPatientOfOtherProvider' => array(),
			'asEmployee' => array(),
			'asCitizen' => array(),
			'asStudent' => array(),
			'asMember' => array(),
			'asOtherIDs' => array(),
			'contactParty' => array(),
			'guardian' => array(),
			'personalRelationship' => array(),
			'birthPlace',
		);
		$this->assigningOrganization = new Organization();
	}


	public function personAddAsPatientOfOtherProvider($asPatientOfOtherProvider)
	{
		$patientOfOtherProvider = new Patient();
		$this->person['asPatientOfOtherProvider'][] = $asPatientOfOtherProvider;
	}

	public function addSubjectOf($subjectOf)
	{
		if (!is_array($this->subjectOf)) {
			$this->subjectOf = array();
		}

		if (is_a($subjectOf, 'Subject4') && !is_null($subjectOf)) {
			$this->subjectOf[] = $subjectOf;
		}
	}
}

 ?>