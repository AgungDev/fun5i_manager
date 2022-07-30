<?php
header('Content-Type: application/json');

require_once '../lib/user.accounts.php';

use fun5i\manager\lib\UserAccounts;

$defaultss = [
    "error" => true,
    "message" => "wrong parms!!",
    "result" => "https://github.com/AgungDev/fun5i_manager"
];

if (isset($_GET["signup"])){
    if (isset($_POST['email'], $_POST['password'], $_POST['fullname'])){
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $fullname   = $_POST['fullname'];
    
        $lib        = new UserAccounts();
        echo json_encode( $lib->registration($fullname, $email, $password) );
    }else{
        echo json_encode($defaultss);
    }

}elseif(isset($_GET["signin"])){
    if (isset($_POST['email'], $_POST['password'])){
        $email      = $_POST['email'];
        $password   = $_POST['password'];
    
        $lib        = new UserAccounts();
        echo json_encode( $lib->login($email, $password) );
        
    }elseif(isset($_POST["token"])){
        $token      = $_POST['token'];

        $lib        = new UserAccounts();
        echo json_encode($lib->getProfile($token));
    }else{
        echo json_encode($defaultss);
    }

}elseif(isset($_GET["update"])){
    $update = $_GET["update"];
    switch($update){
        case "fullname":
            $token          = $_POST['token'];
            $fullname       = $_POST['fullname'];

            $lib        = new UserAccounts();
            echo json_encode( $lib->updateFullname($token, $fullname) );
            break;
        default:
            echo json_encode($defaultss);
            break;
    }
}else{
    echo json_encode("https://github.com/AgungDev/fun5i_manager");
}