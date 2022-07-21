<?php
namespace fun5i\manager\lib;

require_once "config/database.conf.php";
require_once "model/message.conf.php";
require_once "modules/jwt.conf.php";

use Exception;
use fun5i\manager\config\DatabaseConfig;
use fun5i\manager\modules\JwtConfig;
use fun5i\manager\model\MessagesLib;

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

	public function login($email, $password){
		$data = null;
		$email			=	htmlspecialchars( strtolower($email) );
		$password		=	htmlspecialchars( ($password) );

		$query = $this->db->prepare("SELECT * FROM _users WHERE email=:email AND sandi=:password LIMIT 1");
		$query->bindParam(":email", 		$email);

		$encrypt_ = md5($password);
		$query->bindParam(":password", 		$encrypt_);

		try{
			$query->execute();
			$result 		= array();

			while ($row = $query->fetch()) {
				$result['id']			= $row['id'];
				$result['fullname']		= $row['fullname'];
				$result['email']  		= $row['email'];
			}

			if (count($result) == 0) {
				$data = $this->mLib->generate(MessagesLib::$FAILED_LOGIN, null); # Empty user, failed login
			}else{
				$this->jwt->setPayloadJwt(
				[
					"id"       => (int) $result['id'],
					"name"     => (string) $result['fullname'],
					"email"     => (string) $result['email']
				]
				);
				$data = $this->mLib->generate(MessagesLib::$SUCCESS_LOGIN, 
				["token" => $this->jwt->getToken()]); 
			}
			
		}catch(Exception $e){
			$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
		}	

		return json_encode($data);
	}

	public function getId($token){
		$data = null;
		
		try{
			$id = $this->jwt->getPayloadResult($token)->{"id"};
			$data = $this->mLib->generate(MessagesLib::$SUCCESS_READ, $id);
		}catch(Exception $e){
			$data = $this->mLib->generate(MessagesLib::$TOKEN_INVALID, $e);
		}	

		return ($data);
	}

	public function getProfile($token){
		$data = null;
		
		if ($this->getId($token)["error"] ){
			$data = $this->mLib->generate(MessagesLib::$TOKEN_INVALID, $this->getId($token));
		}else{
			$id = $this->getId($token)["result"];
			$query = $this->db->prepare("SELECT * FROM _users WHERE id=:id LIMIT 1");
			$query->bindParam(":id", 		$id);
			try{
				$query->execute();
				$result 		= array();

				while ($row = $query->fetch()) {
					$result['id']			= $row['id'];
					$result['fullname']		= $row['fullname'];
					$result['email']  		= $row['email'];
				}

				if (count($result) == 0) {
					$data = $this->mLib->generate(MessagesLib::$EMPTY_DATA, null); # Empty user, failed login
				}else{
					$data = $this->mLib->generate(MessagesLib::$SUCCESS_READ, [
						"id"       => (int) $result['id'],
						"name"     => (string) $result['fullname'],
						"email"     => (string) $result['email']
					]); 
				}
				
			}catch(Exception $e){
				$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
			}	
		}

		

		return json_encode($data);
	}

	public function updateFullname($token, $newName){
		$data = null;
		$newName = htmlspecialchars( strtolower($newName) );
		try{
			$restokid = $this->getId($token);
			$id = $restokid["result"];
			if( $restokid["error"] ){
				$data = $this->mLib->generate(MessagesLib::$TOKEN_INVALID, null);
			}else{
				$query = $this->db->prepare("UPDATE _users SET fullname=:fullname WHERE id=:id");
				$query->bindParam(":id", 			$id);
				$query->bindParam(":fullname", 		$newName);
				$query->execute();

				$data = $this->mLib->generate(MessagesLib::$SUCCESS_UPDATE, ["new_name" => $newName]);				
			}
				
		}catch(Exception $e){
			$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
		}

		return json_encode($data);
	}

	public function registration($fullname, $email, $password){
		$data = null;
		$fullname		=	htmlspecialchars( strtolower($fullname) );
		$email			=	htmlspecialchars( strtolower($email) );
		$password		=	htmlspecialchars( ($password) );

		if ( !$this->mLib->errorCheck( $this->checkEmail($email) ) ){
			$data = $this->mLib->generate(MessagesLib::$EMAIL_EXIST, null);
		}elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
			$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, null);
		}else{
			try{
				$query = $this->db->prepare("INSERT INTO _users (fullname, email, sandi) VALUES (:fullname, :email, :pass)");
				$query->bindParam(":fullname", 		$fullname);
				$query->bindParam(":email",		 	$email);

				$encrypt_ = md5($password);
				$query->bindParam(":pass", 			$encrypt_);
				$query->execute();

				$data = $this->mLib->generate(MessagesLib::$SUCCESS_REGISTRATION, 
				json_decode($this->login($email, $password))->{"result"} );
			}catch(Exception $e){
				$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
			}
		}

		return json_encode($data);
	}

	public function checkEmail($email){
		$data = null;
		$email			=	htmlspecialchars( strtolower($email) );

		$query = $this->db->prepare("SELECT fullname FROM _users WHERE email=:email LIMIT 1");
		$query->bindParam(":email", $email);

		try{
			$query->execute();
			$result 		= array();
			while ($row = $query->fetch()) {
			    $result['fullname']		= $row['fullname'];
			}
			if (count($result) == 0) {
				$data = $this->mLib->generate(MessagesLib::$EMPTY_EMAIL, null); # Empty user, failed login
			}else{
				$data = $this->mLib->generate(MessagesLib::$SUCCESS_READ, $result); 
			}
		}catch(Exception $e){
			$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
		}	
		
		return json_encode($data);
	}


}

?>