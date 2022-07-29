<?php
namespace fun5i\manager\lib;

require_once "config/database.conf.php";
require_once "model/message.conf.php";
require_once "modules/jwt.conf.php";

use Exception;
use fun5i\manager\config\DatabaseConfig;
use fun5i\manager\modules\JwtConfig;
use fun5i\manager\model\MessagesLib;

class AppsLib {

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

	/*
		create
	*/

	public function createApp($name){
		$data = null;
		$name = htmlspecialchars($name);

		$query = $this->db->prepare("INSERT INTO _apps (name) VALUES (:nama)");
		$query->bindParam(":nama", $name);

		try{
			$query->execute();
			$data = $this->mLib->generate(MessagesLib::$SUCCESS_CREATE, "");
		}catch(Exception $e){
			$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
		}
		return $data;
	}

	public function createVersion($idapp, $versionName){
		$data = null;
		$idapps = htmlspecialchars($idapp);
		$name = htmlspecialchars($versionName);

		$query = $this->db->prepare("INSERT INTO _version_apps (id_apps, version) VALUES (:idapps, :nama)");
		$query->bindParam(":idapps", $idapps);
		$query->bindParam(":nama", $name);

		try{
			$query->execute();
			$data = $this->mLib->generate(MessagesLib::$SUCCESS_CREATE, "");
		}catch(Exception $e){
			$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
		}
		return $data;
	}

	public function createCriteria($idver, $name){
		$data = null;
		$id = htmlspecialchars($idver);
		$name = htmlspecialchars($name);

		$query = $this->db->prepare("INSERT INTO _kriteria (id_version, name) VALUES (:id, :name)");
		$query->bindParam(":id", $id);
		$query->bindParam(":name", $name);

		try{
			$query->execute();
			$data = $this->mLib->generate(MessagesLib::$SUCCESS_CREATE, ["id" => $id, "name" => $name]);
		}catch(Exception $e){
			$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
		}
		return $data;
	}

	public function createSubCriteria($idcri, $name){
		$data = null;
		$id = htmlspecialchars($idcri);
		$name = htmlspecialchars($name);

		$query = $this->db->prepare("INSERT INTO _sub_kriteria (id_kriteria, name) VALUES (:id, :name)");
		$query->bindParam(":id", $id);
		$query->bindParam(":name", $name);

		try{
			$query->execute();
			$data = $this->mLib->generate(MessagesLib::$SUCCESS_CREATE, ["id" => $id, "name" => $name]);
		}catch(Exception $e){
			$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
		}
		return $data;
	}

	/*
		read
	*/

	public function readApp($id=null){
		$data = null;
		$id			=	htmlspecialchars( $id );
		
		if ($id == null){
			$query = $this->db->prepare("SELECT * FROM _apps ORDER BY name ASC");
			try{
				$query->execute();
				$result 		= array();
				$increment = 0;
				while ($row = $query->fetch()) {
					$result[$increment]['id']				= $row['id'];
					$result[$increment]['name']			= $row['name'];
					$increment++;
				}
				$data = $this->mLib->generate(MessagesLib::$SUCCESS_READ, $result); 
			}catch(Exception $e){
				$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
			}
		}else{
			$query = $this->db->prepare("SELECT * FROM _apps WHERE id=:id");
			$query->bindParam(":id", $id);
			try{
				$query->execute();
				$result 		= array();
				while ($row = $query->fetch()) {
					$result['id']			= $row['id'];
					$result['name']			= $row['name'];
				}
				$data = $this->mLib->generate(MessagesLib::$SUCCESS_READ, $result); 
			}catch(Exception $e){
				$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
			}
		}
		return ($data);
	}

	public function readVersion($idApp, $idVersion=null){
		$data = null;
		$id				=	htmlspecialchars( $idVersion );
		$idApp			=	htmlspecialchars( $idApp );
		
		if ($id == null){
			$query = $this->db->prepare("SELECT a.id as id, id_apps, name, version FROM _version_apps a INNER JOIN _apps b ON a.id_apps=b.id WHERE id_apps=:idApp ORDER BY id DESC");
			$query->bindParam(":idApp", $idApp);
			try{
				$query->execute();
				$result 		= array();
				$increment = 0;
				while ($row = $query->fetch()) {
					$result[$increment]['id']				= $row['id'];
					$result[$increment]['id_apps']			= $row['id_apps'];
					$result[$increment]['name']				= $row['name'];
					$result[$increment]['version']			= $row['version'];
					$increment++;
				}
				$data = $this->mLib->generate(MessagesLib::$SUCCESS_READ, $result); 
			}catch(Exception $e){
				$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
			}
		}else{
			$query = $this->db->prepare("SELECT a.id as id, id_apps, name, version FROM _version_apps a INNER JOIN _apps b ON a.id_apps=b.id WHERE id=:id");
			$query->bindParam(":id", $id);
			try{
				$query->execute();
				$result 		= array();
				while ($row = $query->fetch()) {
					$result['id']			= $row['id'];
					$result['id_apps']		= $row['id_apps'];
					$result['name']			= $row['name'];
					$result['version']		= $row['version'];
				}
				$data = $this->mLib->generate(MessagesLib::$SUCCESS_READ, $result); 
			}catch(Exception $e){
				$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
			}
		}
		return ($data);
	}

	public function readCriteria($idVer, $idKRT=null){
		$data = null;
		$idVer			=	htmlspecialchars( $idVer );
		$idKRT			=	htmlspecialchars( $idKRT );
		
		if ($idKRT == null){
			$query = $this->db->prepare("SELECT * FROM _kriteria WHERE id_version=:id ORDER BY id ASC");
			$query->bindParam(":id", $idVer);
			try{
				$query->execute();
				$result 		= array();
				$increment = 0;
				while ($row = $query->fetch()) {
					$result[$increment]['id']				= $row['id'];
					$result[$increment]['id_version']		= $row['id_version'];
					$result[$increment]['name']				= $row['name'];
					$increment++;
				}
				$data = $this->mLib->generate(MessagesLib::$SUCCESS_READ, $result); 
			}catch(Exception $e){
				$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
			}
		}else{
			$query = $this->db->prepare("SELECT * FROM _kriteria WHERE id=:id ORDER BY id ASC");
			$query->bindParam(":id", $idKRT);
			try{
				$query->execute();
				$result 		= array();
				while ($row = $query->fetch()) {
					$result['id']				= $row['id'];
					$result['id_version']		= $row['id_version'];
					$result['name']				= $row['name'];
				}
				$data = $this->mLib->generate(MessagesLib::$SUCCESS_READ, $result); 
			}catch(Exception $e){
				$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
			}
		}
		return ($data);
	}

	public function readSubCriteria($idcri, $idsub=null){
		$data = null;
		$idcri			=	htmlspecialchars( $idcri );
		$idsub			=	htmlspecialchars( $idsub );
		
		if ($idsub == null){
			$query = $this->db->prepare("SELECT * FROM _sub_kriteria WHERE id_kriteria=:id ORDER BY id ASC");
			$query->bindParam(":id", $idcri);
			try{
				$query->execute();
				$result 		= array();
				$increment = 0;
				while ($row = $query->fetch()) {
					$result[$increment]['id']				= $row['id'];
					$result[$increment]['id_kriteria']		= $row['id_kriteria'];
					$result[$increment]['name']				= $row['name'];
					$increment++;
				}
				$data = $this->mLib->generate(MessagesLib::$SUCCESS_READ, $result); 
			}catch(Exception $e){
				$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
			}
		}else{
			$query = $this->db->prepare("SELECT * FROM _sub_kriteria WHERE id=:id ORDER BY id ASC");
			$query->bindParam(":id", $idsub);
			try{
				$query->execute();
				$result 		= array();
				while ($row = $query->fetch()) {
					$result['id']				= $row['id'];
					$result['id_kriteria']		= $row['id_kriteria'];
					$result['name']				= $row['name'];
				}
				$data = $this->mLib->generate(MessagesLib::$SUCCESS_READ, $result); 
			}catch(Exception $e){
				$data = $this->mLib->generate(MessagesLib::$JUST_ERROR, $e);
			}
		}
		return ($data);
	}


}

?>