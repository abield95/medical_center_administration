<?php 


/**
* PatientAddingModel
*/
class PatientAddingModel
{
	
	function __construct()
	{
		# code...
	}

	// set @u = unhex(replace(uuid(),'-',''));
	// insert into patients(id_bin, name)
	// values
	// (
	// 	concat(substr(@u, 7, 2), substr(@u, 5, 2),
	// 			substr(@u, 1, 4), substr(@u, 9, 8)),
	// 		"other values"
	// );

	public static function writeNewPatientToDatabase()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "SET @u unhex(replace(uuid(),'-',''";

		$query = $database->prepare($sql);
		$query->execute();

		$sql = "
			insert into patients(id_bin, name)
			values
			(
				concat(substr(@u, 7, 2), substr(@u, 5, 2),
						substr(@u, 1, 4), substr(@u, 9, 8)),
					:user_name
			)
		";

		$query = $database->prepare($sql);
		$query->execute(array(':user_name' => $user_name));

		$count = $query->rowCount();

		if ($count == 1) {
			return true;
		}

		return false;
	}
}

 ?>