<?php
namespace fun5i\manager\lib;

require_once "../config/database.conf.php";
require_once "../modules/message.conf.php";
require_once "../modules/jwt.conf.php";

use fun5i\manager\config\DatabaseConfig;
use fun5i\manager\modules\JwtConfig;
use fun5i\manager\modules\MessagesLib;

class UserAccounts {

	# main atribute
	private $mLib;
	private $db;
	private $jwt;

	# profile atribute


	public function __construct(){
		$database 		= new DatabaseConfig();
		$this->db 		= $database->connect();
		$this->jwt 		= new JwtConfig("MD5");
		$this->mLib		= new MessagesLib();
	}

	public function login(){
		return ["Nice", "Guys"];
	}


}

?>