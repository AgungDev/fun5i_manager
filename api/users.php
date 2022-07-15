<?php
header('Content-Type: application/json');

require_once '../lib/user.accounts.php';

use fun5i\manager\lib\UserAccounts;

if (isset($_POST['email'], $_POST['password'], $_POST['fullname'])){
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $fullname   = $_POST['fullname'];

    $lib        = new UserAccounts();
    echo $lib->registration($fullname, $email, $password);
    
}elseif (isset($_POST['email'], $_POST['password'])){
    $email      = $_POST['email'];
    $password   = $_POST['password'];

    $lib        = new UserAccounts();
    echo $lib->login($email, $password) ;
    
}elseif (isset($_POST['email'])){
    $email      = $_POST['email'];

    $lib        = new UserAccounts();
    echo $lib->checkEmail($email);
    
}elseif (isset($_POST['fullname'])){
    $fullname      = $_POST['fullname'];

    $lib        = new UserAccounts();
    echo $lib->checkEmail($fullname);
    
}elseif (isset($_POST['token'])){
    $token      = $_POST['token'];

    $lib        = new UserAccounts();
    echo $lib->login($token);
    
}