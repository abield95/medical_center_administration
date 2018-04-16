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
	
	'' => array(
		'level' => "",
		'name' => "",
		'description' => ""
	),
);



 ?>