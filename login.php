<?php 
require_once "lib/modules/cookie.manager.php";
require_once "lib/user.accounts.php";

use fun5i\manager\modules\CookieManager;
use fun5i\manager\lib\UserAccounts;

$cookTok = new CookieManager(CookieManager::$_NAME_TOKEN);
$user = new UserAccounts();
if(isset($_POST['email'], $_POST['password'])){
    $email       = $_POST['email'];
    $password   = $_POST['password'];

    $login = ($user->login($email, $password) );
    if (!$login["error"]){
        $token = $login["result"]["token"];
        $cookTok->set($token);
        header("Location: users/dashboard.php");  
    }else{
        echo "<script>alert('Error: ". $login['message'] ."');</script>";
    }
}
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
    <?php 
    //var_dump($_COOKIE);
    ?>
    <a href="index.php">back..</a>
    <div class="container">
            <form action="" method="POST">
                <div>
                    <div class="logo">
                        <img src="assets/images/ico.png"> 
                        <div class="text-logo">manager</div>
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
    </div>
</body>
</html>