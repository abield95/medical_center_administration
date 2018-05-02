<?php 

/**L Leaf; a term that has no children in the specialization hierarchy, and is selectable in the HL7 tooling, and therefore deemed to be a leaf. 
A Abstract; a term that has children in the specialization hierarchy, but is not, itself, selectable in the HL7 tooling and therefore deemed abstract. 
S Specializable; a term that has children in the specialization hierarchy, and is also selectable in the HL7 tooling and therefore deemed specializable.**/

$roleCode = array(
	'CLAIM' => array(
		'level' => "0-L",
		'name' => "claimant",
		'description' => ""
	),
	
	'GT' => array(
		'level' => "0-L",
		'name' => "Guarantor",
		'description' => "An individual or organization that makes or gives a promise, assurance, pledge to pay or has paid the healthcare service provider."
	),

	'PH' => array(
		'level' => "0-L",
		'name' => "Policy Holder",
		'description' => "Policy holder for the insurance policy."
	),

	'PROG' => array(
		'level' => "0-L",
		'name' => "program eligible",
		'description' => "A party that meets the eligibility criteria for coverage under a program."
	),

	'PT' => array(
		'level' => "0-L",
		'name' => "Patient",
		'description' => "The recipient for the service(s) and/or product(s) when they are not the covered party."
	),

	'_AffiliationRoleType' => array(
		'level' => "0-A",
		'name' => "AffiliationRoleType",
		'description' => "Concepts characterizing the type of association formed by player and scoper when there is a recognized Affiliate role by which the two parties are related. 
			Examples: Business Partner, Business Associate, Colleague 
			Concept Relationships:
			  Generalizes (derived): RESPRSN _CoverageSponsorRoleType _PayorRoleType
			  ClassifiesClassCode to: AFFL ",
		'level1' = array(
			'RESPRSN' => array(
				'level' => "1-S",
				'name' => "responsible party",
				'description' => "The role played by a party who has legal responsibility for another party.",
				'level2' => array(
					'EXCEST' => array(
						'level' => "2-L",
						'name' => "executor of estate",
						'description' => "The role played by a person acting as the estate executor for a deceased subscriber or policyholder who was the responsible party "
					),
					'GUADLTM' => array(
						'level' => "2-L",
						'name' => "guardian ad lidem",
						'description' => "The role played by a person appointed by the court to look out for the best interests of a minor child during the course of legal proceedings. "
					),
					'GUARD' => array(
						'level' => "2-L",
						'name' => "guardian",
						'description' => "The role played by a person or institution legally empowered with responsibility for the care of a ward."
					),
					'POWATT' => array(
						'level' => "2-S",
						'name' => "power of attorney",
						'description' => "A relationship between two people in which one person authorizes another to act for him in a manner which is a legally binding upon the person giving such authority as if he or she personally were to do the acts.",
						'level3' => array(
							'DPOWATT' => array(
								'level' => "3-L",
								'name' => "durable power of attorney",
								'description' => "A relationship between two people in which one person authorizes another, usually a family member or relative, to act for him or her in a manner which is a legally binding upon the person giving such authority as if he or she personally were to do the acts that is often limited in the kinds of powers that can be assigned. Unlike ordinary powers of attorney, durable powers can survive for long periods of time, and again, unlike standard powers of attorney, durable powers can continue after incompetency. "
							),
							'HPOWATT' => array(
								'level' => "3-L",
								'name' => "healthcare power of attorney",
								'description' => "A relationship between two people in which one person authorizes another to act for him or her in a manner which is a legally binding upon the person giving such authority as if he or she personally were to do the acts that continues (by its terms) to be effective even though the grantor has become mentally incompetent after signing the document. "
							),
							'SPOWATT' => array(
								'level' => "3-L",
								'name' => "special power of attorney",
								'description' => "A relationship between two people in which one person authorizes another to act for him or her in a manner which is a legally binding upon the person giving such authority as if he or she personally were to do the acts that is often limited in the kinds of powers that can be assigned. "
							),
						)
					)
				)
			),

			'_CoverageSponsorRoleType' => array(
				'level' => "1-A",
				'name' => "CoverageSponsorRoleType",
				'description' => "Codes that indicate a specific type of sponsor. Used when the sponsor's role is only either as a fully insured sponsor or only as a self-insured sponsor. NOTE: Where a sponsor may be either, use the SponsorParticipationFunction.code (fully insured or self insured) to indicate the type of responsibility. (CO6-0057) ",
				'level2' => array(
					'FULLINS' => array(
						'level' => "2-L",
						'name' => "Fully insured coverage sponsor",
						'description' => "An employer or organization that contracts with an underwriter to assumes the financial risk and administrative responsibility for coverage of health services for covered parties."
					),
					'SELFINS' => array(
						'level' => "2-L",
						'name' => "Self insured coverage sponsor",
						'description' => "An employer or organization that assumes the financial risk and administrative responsibility for coverage of health services for covered parties."
					),
					'' => array(
						'level' => "",
						'name' => "",
						'description' => ""
					),
				)
			),

			'' => array(
				'level' => "",
				'name' => "",
				'description' => ""
			),
		)

	),
	'' => array(
		'level' => "",
		'name' => "",
		'description' => ""
	),
);


 ?>