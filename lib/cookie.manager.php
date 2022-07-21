<?php 

/*
    name        : CookieManager
    Version     : 1.0.0
*/

namespace fun5i\manager\lib;

class CookieManager {


    public static $_NAME_TOKEN = "_ftoken"; 

    private $NAME;
    
    private static $EXPIRES = 86400;// 3600 = 1 Jam;  86400 1 hari
    private static $PATH = "/";
    private static $DOMAIN = "113.14.15.14";
    private static $SECURE = false;
    private static $HTTPONLY = false;
    private static $SAMESITE = 'None';

    public function __construct($names){
        $this->NAME = $names;
    }

    public function delate(){
        /* $arr_cookie_options = array (
                'expires' => time() - CookieManager::$EXPIRES,
                'path' => CookieManager::$PATH,
                'domain' => CookieManager::$DOMAIN, 
                'secure' => CookieManager::$SECURE,   
                'httponly' => CookieManager::$HTTPONLY, 
                'samesite' => CookieManager::$SAMESITE
            ); */
        $arr_cookie_options = array (
            'expires' => time() - CookieManager::$EXPIRES,
            'path' => CookieManager::$PATH,
            'domain' => CookieManager::$DOMAIN
        );
        setcookie(
            CookieManager::$NAME, 
            "", 
            $arr_cookie_options
        );
    }
    
    public function set($token){
        if($this->get() != $token && $this->get() != null){ //change
            $this->delate();
            $this->set($token);
        }else{
            $options = array (
                'expires' => time() + CookieManager::$EXPIRES,
                'path' => CookieManager::$PATH,
                'domain' => CookieManager::$DOMAIN
            );
            setcookie(CookieManager::$NAME, 
                $token, 
                $options
            ); // add 
        }
        
    }

    public function get(){
        $data = null;
        if (isset($_COOKIE[CookieManager::$NAME])){
            $data = $_COOKIE[CookieManager::$NAME];
        }

        return $data;
    }

}

?>