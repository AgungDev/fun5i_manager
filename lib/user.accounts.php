<?php
namespace ganz\lib\fun5i\manager;

require_once "../config/database.conf.php";
require_once "../modules/message.conf.php";
require_once "../modules/jwt.conf.php";

use ganz\config\fun5i\manager\DatabaseConfig;
use ganz\modules\fun5i\manager\JwtConfig;
use ganz\modules\fun5i\manager\MessagesLib;

class UserAccounts {

	private $mLib;
	private $db;
	private $jwt;


	public function __construct($token="accounts"){
		$database 		= new DatabaseConfig();
		$this->db 		= $database->connect();
		$this->jwt 		= new JwtConfig("MD5");
		$this->mLib		= new MessagesLib();

		$this->setPermissions($token);
	}

	private function setPermissions($token){
		if (!$this->jwt->validToken($token)['error']){
			$resToken = $this->jwt->getPayloadResult($token);

			$this->setProfile(
				intval($resToken->{'id'}),
				$resToken->{'name'},
				$resToken->{'nick'},
				intval($resToken->{'level'}),
			);
		}
	}

	private function setProfile($id, $name, $nick, $level){
		$this->id_user = $id;
		$this->fullname = $name;
		$this->username = $nick;
		$this->level_user = $level;
	}

	

}

?>