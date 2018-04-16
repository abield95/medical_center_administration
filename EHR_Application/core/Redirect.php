<?php 

	/**
	 * Class redirect
	 * Simple abstraction for redirecitng users to certain pages
	*/
	class Redirect
	{
		
		public static function toPreviousViewedPageAfterLogin($path)
	    {
	        header('location: https://' . $_SERVER['HTTP_HOST'] . '/' . $path);
	    }

	    /**
	     * To the homepage
	     */
	    public static function home()
	    {
	        header("location: " . Config::get('URL'));
	    }

	    /**
	     * To the defined page, uses a relative path (like "user/profile")
	     *
	     * Redirects to a RELATIVE path, like "user/profile" (which works very fine unless you are using HUGE inside tricky
	     * sub-folder structures)
	     *
	     * @see https://github.com/panique/huge/issues/770
	     * @see https://github.com/panique/huge/issues/754
	     *
	     * @param $path string
	     */
	    public static function to($path)
	    {
	        header("location: " . Config::get('URL') . $path);
	    }
	}

 ?>