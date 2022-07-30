<?php 
require_once "lib/modules/cookie.manager.php";

use fun5i\manager\modules\CookieManager;

//$cookieToken = new CookieManager(CookieManager::$_NAME_TOKEN);
//$cookieToken->set("Agung");
//$cookieToken->delate();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.index.css">
    <title>fun5i manager</title>
</head>
<body>
    <?php 
    //var_dump($cookieToken->get());
    ?>
    <div class="container">
        <ul>
            <li><a href="login.php" class="user">User Login</a></li>
            <li><a href="logindev.php" class="dev">Develohper Login</a></li>
        </ul>
    </div>
</body>
</html>