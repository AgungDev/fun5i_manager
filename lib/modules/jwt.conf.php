<?php

/*
    name        : JwtConfig
    version     : 1.1.7
	ver expl	: algorithm.function.bug
	developher	: fun5i
*/

namespace fun5i\manager\modules;

use Exception;

class JwtConfig {

	private $algoritma = [
		"HS256",
		"MD5"
	];

	public function __construct($selected="HS256"){

		if ( in_array(strtoupper($selected), $this->algoritma) ){
			$this->algJwt = strtoupper($selected);
		}else{
			$this->algJwt = "HS256";
		}

		$this->setHeaderJwt();

	}

	
	private $secretKey = 'secret key';

	public $algJwt;
	public $headerJwt;
	public $payloadJwt;
	public $signatureJwt;

	private function algoritmaJwt($jsonEncode){
		$outs = null;

		if ($this->algoritma[0] == $this->algJwt) {
			// hs256
			$outs = "algotima prepare";
		}elseif ($this->algoritma[1] == $this->algJwt) {
			$outs = md5($jsonEncode);
		}else{
			$outs = "somethink wrong in method algortma Jwt";
		}

		return $outs;
	}

	private function setHeaderJwt(){
		$this->headerJwt = base64_encode(json_encode(
			[
				"alg"		 => strtolower($this->algJwt), 
				"type"		 => "jwt"
			]
		));
	}

	public function setPayloadJwt($payload){
		// ex : { 'nama' : 'agung', 'umur' : 23} 
		$this->payloadJwt = base64_encode(json_encode($payload));
		$this->setSignature(); //build signature
	}

	private function setSignature(){

		$this->signatureJwt = $this->algoritmaJwt(
			json_encode(
				[
					$this->headerJwt, 
					$this->payloadJwt, 
					base64_encode($this->secretKey)
				]
			)
		);

	}

	public function getToken(){
		$token = (((($this->headerJwt."%2E".$this->payloadJwt."%2E".$this->signatureJwt))));
		return base64_encode($token);
	}

	public function getPayloadResult($token){
		$data = false;
		try {
			$data = $this->decodeToken($token)['payload'];
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return $data;
	}
	//token validasi

	public function validToken($token){
		$noterror = false;
		
		try {
			$decodetoken = $this->decodeToken($token);
				//valid token
				$cs =  $this->algoritmaJwt(
					json_encode(
						[
							base64_encode(json_encode( (array) $decodetoken['header'] )),
							base64_encode(json_encode( (array) $decodetoken['payload'] )),
							base64_encode($this->secretKey)
						]
					)
				);
	
				if ( $cs == $decodetoken['signature'] ){
					$noterror = true;
				}else{
					throw new Exception("Tanda tangan server salah");
				}
		}catch(Exception $e){
			echo $e;
		}
		

		return $noterror;
	}

	private function decodeToken($token){
		$out = false;
		$hps64 = explode("%2E", base64_decode($token));
		if ($this->checkString($hps64[0])){
			if ($this->checkString($hps64[1])){
				if ($this->checkString($hps64[2])){
					$out = [
						"header" 		=> json_decode(base64_decode($hps64[0])),
						"payload" 		=> json_decode(base64_decode($hps64[1])),
						"signature" 	=> $hps64[2]
					];
				}else{
					throw new Exception("Error: signature rusak ");
				}
			}else{
				throw new Exception("Error: payload rusak ");
			}
		}else{
			throw new Exception("Error: Header rusak ");
		}
		return $out;
	}

	private function checkString($s){
		$regex = preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s);
		if($regex)
		   return true;
		else
		   return false;
	 }

	private function cekToken($token){

		$out = false;
		$hps64 = explode("%2E", base64_decode($token));
		$jsonH = json_decode(base64_decode($hps64[0]));

		if ( is_object($jsonH) ) {
			if ( in_array(strtoupper($jsonH->{'alg'}), $this->algoritma) ) {
				$out = true;
			}else{
				$out = false;
			}
		}else{
			$out = false;
		}
		
		return $out;
	}
}

?>