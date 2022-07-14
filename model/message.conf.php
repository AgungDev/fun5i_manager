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
	public static $EMPTY_DATA 				= 200;
	public static $EMPTY_EMAIL 				= 201;
	

	# Messange for success and error 
	private $message = [
		1	=> "success create",
		2	=> "success read",
		3	=> "success update",
		4	=> "success delate",

		11	=> "Success login",
		12	=> "Success Regristration",

		100	=> "Just error",
		101	=> "Failed login",
		102	=> "You alredy registration",
		200	=> "[error][get] : Empty Data",
		201	=> "[error][get] : Empty Email",
		
		

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

	public function errorFrom($data){
		return json_decode($data)->{"error"};
	}

	public function __construct(){

	}

	
}

?>