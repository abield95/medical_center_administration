<?php 

	return array(
		'URL' => 'https://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),
    	'PATH_CONTROLLER' => realpath(dirname(__FILE__).'/../../') . '/EHR_Application/controller/',
    	'PATH_VIEW' => realpath(dirname(__FILE__).'/../../') . '/EHR_Application/view/',
        'PATH_BASE' => realpath(dirname(__FILE__).'/../../') . '/EHR_Application/',
        'PATH_HL7_SUPPORTED_CODE_SYSTEM' => realpath(dirname(__FILE__).'/../../') . '/EHR_Application/HL7_SupportedCodeSystems/',


    	'DEFAULT_CONTROLLER' => 'patientAdministration',//index
    	'DEFAULT_ACTION' => 'addPatient',//index

    	//database configuration
    	'DB_TYPE'      => 'mysql',
    	'DB_HOST'      => '127.0.0.1',
    	'DB_NAME'      => 'medical_center',
    	'DB_USER'      => 'root',
    	'DB_PASS'      => 'admin_1234',
    	'DB_PORT'      => '3306',
        'DB_CHARSET'   => 'utf8',


        /**
         *configuration for cookies
        */
        'COOKIE_RUNTIME'    => 1209600,    #1209600 seg, 2 weeks
        'COOKIE_PATH'       => '/',
        'COOKIE_DOMAIN'     => ".adminmed.com",
        'COOKIE_SECURE'     => true,        #true if will be transfered using ssl
        'COOKIE_HTTP'       => true,        #true, cookies can't be accessed using js
        'SESSION_RUNTIME'   => 604800,      #How long should a session cookie will be valid by seconds, 604800 = 1 week
	);

 ?>