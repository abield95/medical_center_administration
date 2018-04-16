<?php 



/////////////////////////////////////////
/*address line*/
$AddressPartType = array(
	"AL" => array(
		'level'	=> 1,
		'name' => "address line",
		'description' 	=> "An address line is for either an additional locator, a delivery address or a street address. An address generally has only a delivery address line or a street address line, but not both.",
		'level2'	=> array(
			"ADL" => array(
				'level'	=> 2,
				'name' => "additional locator",
				'description' => "This can be a unit designator, such as apartment number, suite number, or floor. There may be several unit designators in an address (e.g., '3rd floor, Appt. 342'.) This can also be a designator pointing away from the location (e.g. Across the street from).",

				'level3' => array(
					"UNIT" => array(
						'level'	=> 3,
						'name' => "unit designator",
						'description' => "Indicates the type of specific unit contained within a building or complex. E.g. Appartment, Floor",
					),
					"UNID" => array(
						'level' => 3,
						'name' => "unit identifier",
						'description' => "The number or name of a specific unit contained within a building or complex, as assigned by that building or complex."
					),
				)
			),

			"DAL" => array(
				'level' => 2,
				'name' => "delivery address line",
				'description' => "A delivery address line is frequently used instead of breaking out delivery mode, delivery installation, etc. An address generally has only a delivery address line or a street address line, but not both.",
				'level3' => array(
					"DINSTA" => array(
						'level' => 3,
						'name' => "delivery installation area",
						'description' => "The location of the delivery installation, usually a town or city, and is only required if the area is different from the municipality. Area to which mail delivery service is provided from any postal facility or service such as an individual letter carrier, rural route, or postal route."
					),
					"DINSTQ" => array(
						'level' => 3,
						'name' => "delivery installation qualifier",
						'description' => "A number, letter or name identifying a delivery installation. E.g., for Station A, the delivery installation qualifier would be 'A'. "
					),
					"DINST" => array(
						'level' => 3,
						'name' => "delivery installation type",
						'description' => "Indicates the type of delivery installation (the facility to which the mail will be delivered prior to final shipping via the delivery mode.) Example: post office, letter carrier depot, community mail center, station, etc. "
					),
					"DMOD" => array(
						'level' => 3,
						'name' => "delivery mode",
						'description' => "Indicates the type of service offered, method of delivery. For example: post office box, rural route, general delivery, etc."
					),
					"DMODID" => array(
						'level' => 3,
						'name' => "delivery mode identifier",
						'description' => "Represents the routing information such as a letter carrier route number. It is the identifying number of the designator (the box number or rural route number)."
					)
				)
			),

			"SAL" => array(
				//start level 2 SAL
				'level' => 2,
				'name' => "street address line",
				'description' => "A street address line is frequently used instead of breaking out build number, street name, street type, etc. An address generally has only a delivery address line or a street address line, but not both",
				'level3' => array(
					//start level 3 SAL
					"BNR" => array(
						'level' => 3,
						'name' => "building number",
						'description' => "The number of a building, house or lot alongside the street. Also known as \"primary street number\". This does not number the street but rather the building. ",
						'level4' => array(
							//start level4 SAL BNR
							"BNN" => array(
								'level' => 4,
								'name' => "building number numeric",
								'description' => "The numeric portion of a building number"
							),
							"BNS" => array(
								'level' => 4,
								'name' => "building number suffix",
								'description' => "Any alphabetic character, fraction or other text that may appear after the numeric portion of a building number"
							)
							//end level 4 SAL BNR
						)
					),

					"STR" => array(
						//start level 3 STR
						'level' => 3,
						'name' => "street name",
						'description' => "The name of the street, including the type",
						'level4' => array(
							//start level4 STR
							"STB" => array(
								'level' => 4,
								'name' => "street name base",
								'description' => "The base name of a roadway or artery recognized by a municipality (excluding street type and direction)"
							),
							"STTYP" => array(
								'level' => 4,
								'name' => "street type",
								'description' => "The designation given to the street. (e.g. Street, Avenue, Crescent, etc.)"
							)
							//end level4 STR
						)
						//end level3 STR
					),

					"DIR" => array(
						'level' => 3,
						'name' => "direction",
						'description' => "Direction (e.g., N, S, W, E)"
					)
					//end level 3 SAL
				)
				//end level 2 SAL
			),
			
			"INT" => array(
				'level' => 2,
				'name' => "intersection",
				'description' => "An intersection denotes that the actual address is located at or close to the intersection of two or more streets"
			)

		)
	),
	
	"CAR" => array(
		'level' => 1,
		'name' => "care of",
		'description' => "The name of the party who will take receipt at the specified address, and will take on responsibility for ensuring delivery to the target recipient "
	),
	
	"CEN" => array(
		'level' => 1,
		'name' => "census tract",
		'description' => "A geographic sub-unit delineated for demographic purposes."
	),
	
	"CNT" => array(
		'level' => 1,
		'name' => "country",
		'description' => "Country"
	),
	
	"CPA" => array(
		'level' => 1,
		'name' => "country or parish",
		'description' => "A sub-unit of a state or province. (49 of the United States of America use the term "county;" Louisiana uses the term "parish".)"
	),
	
	"DEL" => array(
		'level' => 1,
		'name' => "delimiter",
		'description' => "Delimiters are printed without framing white space. If no value component is provided, the delimiter appears as a line break."
	),
	
	"CTY" => array(
		'level' => 1,
		'name' => "municipality",
		'description' => "The name of the city, town, village, or other community or delivery center"
	),
	
	"POB" => array(
		'level' => 1,
		'name' => "post box",
		'description' => "A numbered box located in a post station."
	),
	
	"ZIP" => array(
		'level' => 1,
		'name' => "postal code",
		'description' => "A postal code designating a region defined by the postal service."
	),
	
	"PRE" => array(
		'level' => 1,
		'name' => "precinct",
		'description' => "A subsection of a municipality"
	),
	
	"STA" => array(
		'level' => 1,
		'name' => "state or province",
		'description' => "A sub-unit of a country with limited sovereignty in a federally organized country."
	)
);
 ?>