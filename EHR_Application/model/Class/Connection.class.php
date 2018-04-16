<?php 

	/**
	* Connceting to mysql server
	*/
	class Connection
	{
		
		private $dbhost;
		private $dbuser;
		private $dbpass;
		private $dbname;
		private $conn;

		function __construct()
		{
			$this->dbhost = 'localhost:3306';
			$this->dbuser = 'root';
			$this->dbpass = 'admin_1234';
			$this->dbname = "medical_center";
		}

		function startConnection()
		{
			$this->conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);

			if (mysqli_connect_errno()) {
				# code...
				printf("Connection Failed: %s\n", mysqli_connect_error());
				exit();
			}

			echo "Connetion succesfull\n";
		}

		function getConnection()
		{
			return $this->conn;
		}

		function closeConnection()
		{
			if (mysqli_ping($this->conn)) {
				# code...
				mysqli_close($this->conn);
			}
		}

		function executeQuery($query)
		{
			//if (!$this->conn) {
				# code...
				$this->startConnection();
			//}

			$result = mysqli_query($this->conn, $query);

			return $result;
			
		}

		function executeMultiQuery($query)
		{
			if (mysqli_multi_query($this->conn, $query)) {
				$cumulative_rows = 0;
				do{
        			//echo "<br>$query<br>";
        			$cumulative_rows+=$aff_rows=mysqli_affected_rows($this->conn);
        			echo "Affected Rows = $aff_rows, ";
        			echo "Cumulative Affected Rows = $cumulative_rows<br>";
    			} while(mysqli_more_results($this->conn) && mysqli_next_result($this->conn));
			}

			if($error_mess=mysqli_error($this->conn)){
    			echo "<br>",array_shift($query),"<br>Error = $error_mess";
			}
		}

		function insert($query)
		{
			$result = $this->executeQuery($query);
			if ($result) {
				# code...
				echo "New Record created";
			}
			else
				echo "Error inserting: ".$query."  ".mysqli_error($this->conn)."\n";
		}

		function fetchAssoc($result)
		{
			if (mysqli_num_rows($result) > 0) {
				# code...
				while ($row = mysqli_fetch_assoc($result)) {
					# code...
					echo "Name: ".$row['name']." ---ID Text: ".$row['id_text'];
				}
			}
			else
			{
				echo "No results";
			}
		}

	}

 ?>