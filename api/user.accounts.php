<?php

require_once "../lib/database.conf.php";
require_once "../lib/message.conf.php";
require_once "../lib/jwt.conf.php";


class UserAccounts {

	public function getAllKaryawan(){
		$out = $this->Outs(101, null);

		if ($this->level_user == Account::$permissions_owner){
			

			$query = $this->db->prepare("SELECT * FROM users WHERE level=2");

			if ( $query->execute() ) {
				$result 		= array();
				$active 		= 0;
				$increment = 0;
				while ($row = $query->fetch()) {
				    $result[$increment]['id']			= $row['id'];
				    $result[$increment]['name']			= $row['name'];
				    $result[$increment]['nick']  		= $row['nick'];
				    $result[$increment]['level']   		= $row['level'];

				    $increment++;
				}

				$out = $this->Outs(10, $result);

				
			}else{
				$out = $this->Outs(300, null);
			}
		}
		return $out;
	}

	# constructor and atributes

	private $db;
	private $jwt;

	#user accounts
	private $id_user;
	private $fullname = "Kosong";
	private $username = "Kosong";

	public function __construct($token="accounts"){
		$this->level_user = Account::$permissions_all;
		$database 		= new ganz\modules\fun5i\manager\DatabaseConfig();
		$this->db 		= $database->connect();
		$this->jwt 		= new ganz\modules\fun5i\manager\JwtConfig("MD5");

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

	public function getId(){
		return $this->id_user;
	}

	public function getFullname(){
		return $this->fullname;
	}

	public function getNick(){
		return $this->username;
	}

	public function getLevel(){
		return $this->level_user;
	}

	public function getProfile(){
		$result = $this->Outs(110, null);

		if (!empty( $this->getId()) ) {
			$this->jwt->setPayloadJwt(
		      [
		        "id"       => (int) $this->getId(),
		        "name"     => (string) $this->getFullname(),
		        "nick"     => (string) $this->getNick(),
		        "level"    => (int) $this->getLevel()
		      ]
		    );
		    $out = [
				"id" => $this->getId(),
				"name" => $this->getFullname(),
				"nick" => $this->getNick(),
				"level" => $this->getLevel(),
				"token" => $this->jwt->getToken()
			];
			$result = $this->Outs(10,$out);
		}

		return $result;
	}

	# Login all accounts

	public function login($nick="kosong", $password="kosong"){
		$username 	= htmlspecialchars( strtolower($nick) );
		$pass 		= md5($password);

		$query = $this->db->prepare("SELECT * FROM users WHERE nick=:nick and password=:password LIMIT 1");
		$query->BindParam(':nick', 			$username );
		$query->BindParam(':password',			$pass );

		if ( $query->execute() ) {
			$result 		= array();
			$active 		= 0;
			while ($row = $query->fetch()) {
			    $result['id']			= $row['id'];
			    $result['name']			= $row['name'];
			    $result['nick']  		= $row['nick'];
			    $result['level']   		= $row['level'];
			}

			if (count($result) == 0) {
				$out = $this->Outs(100, null); # Empty user, failed login
			}else{
				$this->jwt->setPayloadJwt(
			      [
			        "id"       => (int) $result['id'],
			        "name"     => (string) $result['name'],
			        "nick"     => (string) $result['nick'],
			        "level"    => (int) $result['level']
			      ]
			    );
				$out = $this->Outs(11, $this->jwt->getToken()); 
			}

			
		}else{
			$out = $this->Outs(300, null);
		}	

		return $out;
	}

	

	

}

?>