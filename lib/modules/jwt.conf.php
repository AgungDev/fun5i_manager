<?php

/*
    name        : JwtConfig
    Version     : 1.0.0
*/

namespace fun5i\manager\modules;


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
		return $this->decodeToken($token)['payload'];
	}
	//token validasi

	public function validToken($token){
		$out = null;
		$error = true;
		$tok = $this->decodeToken($token);
		if ($tok != "wrong") {
			//valid token

			$cs =  $this->algoritmaJwt(
				json_encode(
					[
						base64_encode(json_encode( (array) $tok['header'] )),
						base64_encode(json_encode( (array) $tok['payload'] )),
						base64_encode($this->secretKey)
					]
				)
			);

			if ( $cs == $tok['signature'] ){
				$error = false;
				$out = [
					"error"		=> $error,
					"msg"		=> "succes!",
					"result"	=> ($tok['payload'])
				];
			}else{
				$out = [
					"error"		=> $error,
					"msg"		=> "Tanda tangan server salah"
				];
			}
			//$out = [$tok['signature'], $cs, base64_encode( json_encode ( $tok['header'] )) ];

		}else{
			$out = [
				"error"		=> $error,
				"msg"		=> "token tidak valid"
			];
		}

		return (array) json_decode(json_encode($out));
	}

	private function decodeToken($token){
		$out = "wrong";
		if ( $this->cekToken($token) ){
			$hps64 = explode("%2E", base64_decode($token));

			$out = [
				"header" 		=> json_decode(base64_decode($hps64[0])),
				"payload" 		=> json_decode(base64_decode($hps64[1])),
				"signature" 	=> $hps64[2]
			];
		}
		
		return $out;
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