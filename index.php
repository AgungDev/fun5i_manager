<?php 

require_once "lib/cookie.manager.php";

use fun5i\manager\lib\CookieManager;

$cookieManager = new CookieManager();
if($cookieManager->get()!= null){
    var_dump($cookieManager->get());
}else{
    $cookieManager->set("agung");
    echo "empty";
}


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
    <div class="container">
         <?php 
            
         ?>
    </div>
</body>
</html>