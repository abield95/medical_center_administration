<?php 

	/**
	* Session class
	*Create session if no exists, sets and gets values and closes the session
	*Check if user is logged in or not
	*/
	class Session
	{
		
		public static function init()
		{
			if (session_id() == '') {
				//start the session
				session_start();
			}
		}

		/**
		*Sets a specific value to a specific key of the session
		*@param mixed $key key
		*@param mixed $value value
		**/
		public static function set($key, $value)
		{
			$_SESSION[$key] = $value;
		}


		/**
		*gets/returns the value of a specific value of a specific key of the session
		*@param mixed @key ussuali a string
		*@return mixed the key's value or nothing
		**/
		public static function get($key)
		{
			if (isset($_SESSION[$key])) {
				# code...
				$value = $_SESSION[$key];

				//filter the value for XSS vulnerabilities
				return Filter::XSSFilter($value);
			}
		}

		/**
		*adds a value as a new array element to the key.
		*useful for collecting error messages
		*@param mixed $key
		*@param mixed $value
		**/
		public static function add($key, $value)
		{
			$_SESSION[$key][] = $value;
		}


		/**
		*deletes the sesssion === the users log's out
		**/
		public static function destroy()
		{
			session_destroy();
		}

		/**
		*update session id in database
		**/
		public static function updateSessionId($userId, $sessionId = null)
		{
			//database connection
			$sql = "UPDATE users SET session_id = :session_id WHERE user_id = :user_id";

			#$query = $database->prepare($sql);
			#$query->execute(array(':session_id' => $sessionId, ':user_id' => $userId));
		}

		/**
		*check for session concurrency
		**/
		public static function isConcurrentSessionExists()
		{
			$session_id = session_id();
			$userId = Session::get('user_id');

			if (isset($userId) && isset($session_id)) {
				# code...
				//check in he database
				#connect to database
				$sql = "SELECT session_id FROM users WHERE user_id = :user_id LIMIT 1";

				#PREPARE QUERY=>$query = $database->prepare($sql);
				#execute query => $query->execute(array(":user_id" => $userID));

				$result = $query->fetch();
				$userSessionId = !empty($result) ? $result->session_id: null;

				return $session_id !== $userSessionId;
			}

			return false;
		}

		/**
		*check if the user is logged in or not
		*@return boll user's login status
		**/
		public static function userIsLoggedIn()
		{
			return (self::get('user_logged_in') ? true : false);
		}
	}

 ?>