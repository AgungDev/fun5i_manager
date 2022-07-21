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

    public function __construct($names){
        $this->NAME = $names;
    }

    public function delate(){
        $arr_cookie_options = array (
            'expires' => time() - CookieManager::$EXPIRES,
            'path' => CookieManager::$PATH,
            'domain' => CookieManager::$DOMAIN
        );
        setcookie(
            $this->NAME, 
            "", 
            $arr_cookie_options
        );
    }
    
    public function set($val){
        if($this->get() != $val && $this->get() != null){ //change
            $this->delate();
            $this->set($val);
        }else{
            $options = array (
                'expires' => time() + CookieManager::$EXPIRES,
                'path' => CookieManager::$PATH,
                'domain' => CookieManager::$DOMAIN
            );
            setcookie($this->NAME, 
                $val, 
                $options
            ); // add 
        }
    }

    public function get(){
        $data = null;
        if (isset($_COOKIE[$this->NAME])){
            $data = $_COOKIE[$this->NAME];
        }

        return $data;
    }

}

?>