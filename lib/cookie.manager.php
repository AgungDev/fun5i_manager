<?php 

namespace fun5i\manager\lib;

class CookieManager {

    private static $NAME = "fun5i_manager"; 
    private static $ERROR_NAME = "Error: empty coockie name"; 
    private static $TIME_CLEAN = 86400 * 30;// 1 day

    public function __construct(){
        
    }
    
    public function set($token){
        if($this->get() != $token){
            unset($_COOKIE[CookieManager::$NAME]);//remove
            setcookie(CookieManager::$NAME, "", time() - CookieManager::$TIME_CLEAN, "/");
        }
        /* setcookie(CookieManager::$NAME, 
            $token, 
            time() + CookieManager::$TIME_CLEAN, "/"); // add  */
    }

    public function get(){
        $data = null;
        if (isset($_COOKIE[CookieManager::$NAME])){
            $data = $_COOKIE[CookieManager::$NAME];
        }else{
            $data = CookieManager::$ERROR_NAME;
        }

        return $data;
    }

}

?>