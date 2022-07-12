<?php
header('Content-Type: application/json');

require_once '../lib/user.accounts.php';

use ganz\lib\fun5i\manager\UserAccounts;

if (isset($_POST['username'], $_POST['password'])){
    $username   = $_POST['username'];
    $password   = $_POST['password'];

    $connect    = new UserAccounts();
    echo json_encode("Connect");
    
}else{
    echo json_encode("Hello wordls");
}