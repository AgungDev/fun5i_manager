<?php 
require_once "../lib/admin.accounts.php";

use fun5i\manager\lib\AdminAccounts;
        

class PublicFunction {

    private $token;
    private $admin;

    public function __construct(){
        
    }

    public function checkAuth(){
        $this->admin = new AdminAccounts();
        if (isset($_GET['auth'])){
            $this->token = $_GET['auth'];
            $this->token = htmlspecialchars($_GET['auth']);
            $id = $this->admin->getId($this->token);
            if ($id['error']){
                header("Location: ../logindev.php?error=".$id['message']);
            } 
        }else{
            header("Location: ../logindev.php?error=wrong%20prams");
        }

        return $this->token;
    }

}