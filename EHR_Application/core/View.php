<?php 

	/**
	* Class View
	*handle all the output
	*/
	class View
	{
		
		public function render($filename, $data = null)
		{
			if ($data) {
				foreach ($data as $key => $value) {
					$this->{$key} = $value;
				}
			}

			require Config::get('PATH_VIEW') . 	'_templates/header.php';
			require Config::get('PATH_VIEW') . $filename . '.php';
			require Config::get('PATH_VIEW') . '_templates/footer.php';
		}

		public function renderMulti($filenames, $data = null)
		{
			#like render() but access a separate array of views
			#use like $this->view->renderMulti9array('file1.php', 'file2.php')
			if (!is_array($filenames)) {
				self::render($filenames, $data);
				return false;
			}

			if ($data) {
				foreach ($data as $key => $value) {
					$this->{$key} = $value;
				}
			}

			require Config::get('PATH_VIEW') . '_templates/header.php';
			foreach ($filenames as $filename) {
				require Config::get('PATH_VIEW') . $filename . '.php';
			}

			require Config::get('PATH_VIEW') . '_templates/footer.php';
		}

		public function renderWithoutHeaderAndFooter($filename, $data = null)
		{
			if ($data) {
				foreach ($data as $key => $value) {
					$this->{$key} = $value;
				}
			}

			require Config::get('PATH_VIEW') . $filename . '.php';
		}

		/**
		*Renders pure JSON to the browser, usefull for api constructions
		*@param $data
		**/
		public function renderJSON($data)
		{
			header("Content-Type: application/json");
			echo json_encode($data);
		}

		public function renderFeedbackMessages()
		{
			//echo out the feedback messages (errors and success messages, etc)
			//they are in $_SESSION['feedback_possitive' and $_SESSION['feedback_negative']]
			require Config::get('PATH_VIEW') . '_templates/feedback.php';

			//delete these messages (as they are not needed anymore and we want to avoid to show them twice)
			Session::set('feedback_possitive', null);
			Session::set('feedback_negative', null);
		}

		/**
		*check if the passed string is the currently active controller
		*useful for handling the navigations actiev/non-active link
		*@param string $filename
		*@param string $navigation_controller
		*@return boll shows if the controller is used or not
		**/
		public static function checkForActiveController($filename, $navigation_controller)
		{
			$split_filename = explode("/", $filename);
			$active_controller = $split_filename[0];
			if ($active_controller == $navigation_controller) {
				return true;
			}

			return false;
		}

		/**
		*check if the passed string is the currently active controller-action(=method)
		*@param string $filename
		*@param string $navigation_action
		*@return bool Shows if the action/method is used or not
		**/
		public static function checkForActiveAction($filename, $navigation_action)
		{
			$split_filename = exp("/", $filename);
			$active_action = $split_filename[1];

			if ($active_action == $navigation_action) {
				return true;
			}

			return false;
		}

		public static function checkForActiveControllerAndAction($filename, $navigation_controller_and_action)
		{
			$split_filename = explode("/", $filename);
			$active_controller = $split_filename[0];
			$active_action = $split_filename[1];

			$split_filename = explode("/", $navigation_controller_and_action);
			$navigation_controller = $split_filename[0];
			$navigation_action = $split_filename[1];

			if ($active_controller == $navigation_controller AND $active_action == $navigation_action) {
				return true;
			}

			return false;
		}

		/**
		*Converts characters to HTML entities
		*this is important to avoid XSS attacks, and attemps to inject malicious code in th epage
		*@param string $str The string
		*@return string
		**/
		public function encodeHTML($str)
		{
			return htmlentities($str, ENT_QUOTES, 'UTF-8');
		}

		
	}

 ?>