<?php 
require_once "../lib/user.accounts.php";
require_once "../lib/modules/cookie.manager.php";
require_once "../lib/apps.php";

use fun5i\manager\modules\CookieManager;
use fun5i\manager\lib\UserAccounts;
use fun5i\manager\lib\AppsLib;
        

class PublicFunction {

    private $token;
    private $user;
    private $appsLib;

    public function __construct(){
        $this->token = new CookieManager(CookieManager::$_NAME_TOKEN);
        $this->user = new UserAccounts();
        $this->appsLib = new AppsLib();
    }

    public function getAppLib(){
        return $this->appsLib;
    }


    public function checkAuth(){
        if ($this->getToken() != null){
            $id = $this->user->getId($this->getToken());
            if ($id['error']){
                header("Location: ../logindev.php?error=".$id['message']);
                $this->cookTok->delate();
            } 
        }else{
            header("Location: ../logindev.php?error=need%20token");
            $this->cookTok->delate();
        }
    }

    public function logout(){
        header("Location: ../logindev.php");
        $this->cookTok->delate();
    }

    public function getToken(){
        return $this->token->get();
    }

}