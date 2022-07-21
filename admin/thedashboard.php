<?php 
require_once "../lib/admin.accounts.php";

use fun5i\manager\lib\AdminAccounts;

$adminAccount = new AdminAccounts();
if (isset($_GET['auth'])){
    $token = htmlspecialchars($_GET['auth']);
    $id = $adminAccount->getId($token);
    if ($id['error']){
        header("Location: ../logindev.php?error=".$id['message']);
    } 
}else{
    header("Location: ../logindev.php?error=wrong%20prams");
}

echo "Developher dashboard";
?>