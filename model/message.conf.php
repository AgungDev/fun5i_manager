<?php

namespace fun5i\manager\model;


class MessagesLib {

	# asdasd
	public static $SUCCESS_CREATE			 = 1;
	public static $SUCCESS_READ				 = 2;
	public static $SUCCESS_UPDATE			 = 3;
	public static $SUCCESS_DELATE			 = 4;

	
	public static $SUCCESS_LOGIN 			= 11;
	public static $SUCCESS_REGISTRATION 	= 12;

	# User Error
	public static $JUST_ERROR				= 100;
	public static $FAILED_LOGIN 			= 101;
	public static $EMAIL_EXIST	 			= 102;
	public static $FAILED_CREATE			= 111;
	public static $FAILED_READ				= 112;
	public static $FAILED_UPDATE			= 113;
	public static $FAILED_DELATE			= 114;
	public static $EMPTY_DATA 				= 200;
	public static $EMPTY_EMAIL 				= 201;
	public static $TOKEN_INVALID 				= 202;
	

	# Messange for success and error 
	private $message = [
		1	=> "success create",
		2	=> "success read",
		3	=> "success update",
		4	=> "success delate",

		11	=> "success login",
		12	=> "success regristration",

		100	=> "just error",
		101	=> "failed login",
		102	=> "you alredy registration",
		111	=> "failed create",
		112	=> "failed read",
		113	=> "failed update",
		114	=> "failed delate",
		200	=> "[error][get] : empty data",
		201	=> "[error][get] : empty email",
		201	=> "[error][get] : token invalid",
		
		

	];

	public function generate($error=100, $res=null){
		if (is_numeric($error)) {
			return [
				"error" => ($error < 100)? false: true, 
				"message" =>$this->message[$error], 
				"result" => $res
			];
		}else{
			return 0;
		}
	}

	public function errorCheck($data){
		return json_decode($data)->{"error"};
	}

	public function __construct(){

	}

	
}

?>