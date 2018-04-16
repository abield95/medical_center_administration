<?php 

/**
* 
*/
class Employee
{
	
	function __construct(argument)
	{
		# code...
	}
}

/**
* Person
*/
class Person
{
	$id; //identify this person only for matching purposes
	$name; //one or more names for this person(required)
	$desc;
	$telecom;//telecomunication adresses for comunicating with these person
	$administrativeGenderCode; //M or F
	$birthTime; //date and time these person was born eg: January 1, 1960 @ 03:00:00 EST
	$deceasedInd; //indication these person is dead: true:dead, false:alive
	$deceasedTime; //date and time these person died, exact time: January 1, 1960 @ 03:00:00 EST only if $deceasedind=true;
	$multipleBirthInd; //true: is part of a multiple birth, false: single birth
	$multipleBirthOrderNumber; //if $multipleBirthInd=true order in which these person was born eg: 1 first, 2 seconf, etc
	$organDonorInd; //true: candidate to serve as an organ donor Note: specifics of an organ donor agreement would be conveyed in a medico-legal document.
	$addr; //addresses corresponding to these person
	$maritalStatusCode; //eg: Married, separated, divorced, widowed, common-law marriage.
	$educationLevelCode; //eg: Elementary school; high school or secondary school degree complete; college or baccalaureate degree complete.
	$disabilityCode; //set of values identifying this person disabilities
	$livingArrangementCode; //value specifying the housing of this person
	$religiousAffiliationCode; //value representing the primary religious preference
	$raceCode; //set of Values representing the etnic grop

	//associations
	$Citizen;// - a relationship between the focal person who owes loyalty to and is entitled by birth or naturalization to the protection of a Nation 
	$Employee;// - a relationship of the focal person with an organization to receive wages or salary. The purpose of this class is to identify the type of relationship the employee has to the employer rather than the nature of the work actually performed. 
	$Student; //- a relationship of the focal person to a school in which they are enrolled 
	$Personal //Relationship is another person related to the focal person such as parent, sibling, spouse, neighbor 
	$CareGiver; //  is a person who provides primary care for the focal person at home 
	$ContactParty; // is a person or organization that is authorized to provide or receive information about the focal person 
	$Guardian; // is a person or an organization that is legally responsible for the care and management of the focal person 
	$Member; // is the membership of the focal person in a Group such as a family, tribe or religious organization 
	$OtherIDs; //  conveys identifiers assigned to the focal person in other systems 
	$Guarantor; // is a person or organization that takes financial responsibility for the health care of the focal person 
	$BirthPlace; //is the location where the focal person was born 
	$LanguageCommunication; // - the language communication capability of the focal person 

	function __construct(argument)
	{
		# code...
	}
}

/**
* Citizen class
*A formal relationship between the focal person (player) who owes 
*loyalty to and is entitled by birth or naturalization to the 
*protection of a nation (scoper) 
*/
class Citizen
{
	private $code;
	private $effectiveTime; //An interval of time specifying the period during which this citizenship is in effect, if such time limit is applicable and known 
	function __construct(argument)
	{
		# code...
	}
}

 ?>