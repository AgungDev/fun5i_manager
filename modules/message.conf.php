<?php

namespace ganz\modules\fun5i\manager;


class MessagesLib {

	# asdasd
	public static $SUCCESS_CREATE = 1;
	public static $SUCCESS_READ = 2;
	public static $SUCCESS_UPDATE = 3;
	public static $SUCCESS_DELATE = 3;

	# Messange for success and error 
	private $message = [
		1	=> "success create",
		2	=> "success read",
		3	=> "success update",
		4	=> "success delate",

		11	=> "Success login",
		12	=> "Success Regristrasi",

		100	=> "[error][insert] : Failed login",
		101	=> "[error][insert] : You are not owner",
		110	=> "[error][get] : Empty Data",
		
		300	=> "[error][execute] : Just error",

	];

	public function Outs($error=100, $res=null){
		if (is_numeric($error)) {
			return [
				"error" => ($error < 100)? true: false, 
				"message" =>$this->message[$error], 
				"result" => $res
			];
		}else{
			return 0;
		}
		
	}

	public function __construct(){

	}

	
}

?>