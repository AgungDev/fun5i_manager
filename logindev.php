<?php 
require_once "lib/modules/cookie.manager.php";
require_once "lib/admin.accounts.php";

use fun5i\manager\modules\CookieManager;
use fun5i\manager\lib\AdminAccounts;

$cookTok = new CookieManager(CookieManager::$_NAME_TOKEN);
/* $admin = new AdminAccounts();
if(isset($_POST['email'], $_POST['password'])){
    $email       = $_POST['email'];
    $password   = $_POST['password'];

    $login = json_decode($admin->login($email, $password) );
    if (!$login->{"error"}){
        $token = $login->{"result"}->{"token"};
        $cookTok->set($token);
        header("Location: admin/thedashboard.php");  
    }else{
        echo "<script>alert('Error: ". $login->{'message'} ."');</script>";
    }
} */
$cookTok->set("agung");
var_dump($cookTok->get());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.login.css">
    <title>fun5i manager</title>
</head>
<body>
    <div class="container">
        <?php 
        if(isset($_GET['error'])){
            echo htmlspecialchars($_GET['error']);
        }
        ?>
            <form action="" method="POST">
                <div>
                    <div class="logo">
                        <img src="assets/images/ico.png"> 
                        <div class="text-logo">manager developher</div>
                    </div>
                    
                    <div class="typetext">
                        <div class="ttex">Email</div>
                        <div class="ttin">
                            <input type="email" placeholder="email" name="email">
                        </div>
                    </div>
                    <div class="typetext">
                        <div class="ttex">Password</div>
                        <div class="ttin">
                            <input type="password" placeholder="password" name="password"> 
                        </div>
                    </div>

                    <div class="action">
                        <button>Login ??</button>
                    </div>
                </div>
            </form>

            <?php
            
            ?>
    </div>
</body>
</html>