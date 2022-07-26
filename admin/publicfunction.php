<?php 
require_once "../lib/admin.accounts.php";
require_once "../lib/modules/cookie.manager.php";

use fun5i\manager\modules\CookieManager;
use fun5i\manager\lib\AdminAccounts;
        

class PublicFunction {

    private $token;
    private $admin;

    public function __construct(){
        $this->token = new CookieManager(CookieManager::$_NAME_TOKEN);
        $this->admin = new AdminAccounts();
    }

    public function checkAuth(){
        var_dump($_COOKIE);
        if ($this->getToken() != null){
            $id = $this->admin->getId($this->getToken());
            if ($id['error']){
                //header("Location: ../logindev.php?error=".$id['message']);
                //$this->cookTok->delate();
            } 
        }else{
            //header("Location: ../logindev.php?error=need%20token");
            //$this->cookTok->delate();
        }
    }

    public function getToken(){
        return $this->token->get();
    }

}