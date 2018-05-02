<?php 

/**
* Orgnization
*/
class Organization
{
	private $classCode;
	private $determinerCode;
	private $id;//uuid();
	private $code;
	private $name;
	private $desc;
	private $statusCode;
	private $telecom;
	private $addr;
	private $standardindustryClassCode;
	private $asOrganizationPartOf;//[0...*]OrganizationPartOf
	private $contactParty;#[0...*]ContactParty
	private $organizationContains;#[0...*]OrganizationContains
	function __construct()
	{
		$this->classCode = "ORG";
		$this->determinerCode = "INSTANCE";
		$this->asOrganizationPartOf = array();
		$this->contactParty = array();
		$this->organizationContains = array();
	}
}

/**
* OrganizationPartOf
*/
class OrganizationPartOf
{
	private $classCode;
	private $id;
	private $code;
	private $statusCode;
	private $effectiveTime;
	private $wholeOrganization;# [0....1]Organization
	function __construct()
	{
		# code...
	}
}

/**
* ContactParty
*/
class ContactParty
{
	private $classCode;
	private $id;
	private $code;
	private $addr;
	private $telecom;
	private $contactPerson;# [0..1]Person
	function __construct()
	{
		$this->contactPerson = array();
	}
}
/**
* Person
*/
class Person
{
	private $classCode;
	private $determinerCode;
	private $name;
	private $asLocateEntity;# [0..1](_locationLocatedUniversal)
	function __construct()
	{
	}
}

/**
* OrganizationContains
*/
class OrganizationContains
{
	private $classCode;
	private $id;
	private $code;
	private $StatusCode;
	private $effectiveTime;
	private $partOrganization;#[0..1]Organization
	function __construct()
	{
	}
}

 ?>