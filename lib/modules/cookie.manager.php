<?php 

/*
    name        : CookieManager
    Version     : 1.0.1
	ver expl	: algorithm.function.bug
	developher	: fun5i
*/

namespace fun5i\manager\modules;

class CookieManager {


    public static $_NAME_TOKEN = "_ftoken"; 

    private $NAME;
    
    private static $EXPIRES = 86400;// 3600 = 1 Jam;  86400 1 hari
    private static $PATH = "/";
    private static $DOMAIN = "113.14.15.14";

    public function __construct($names){
        $this->NAME = $names;
    }

    public function delate(){
        $arr_cookie_options = array (
            'expires' => time() - CookieManager::$EXPIRES,
            'path' => CookieManager::$PATH
        );
        setcookie(
            $this->NAME, 
            "", 
            $arr_cookie_options
        );
    }
    
    public function set($val){
        $options = array (
            'expires' => time() + CookieManager::$EXPIRES,
            'path' => CookieManager::$PATH
        );
        setcookie($this->NAME, 
            $val, 
            $options
        ); // add 
        
    }

    public function get(){
        if (isset($_COOKIE[$this->NAME]))
            return $_COOKIE[$this->NAME];
        return null;
    }

}

?>