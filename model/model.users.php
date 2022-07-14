<?php

namespace fun5i\manager\model;

class Users {

    private $id, $fullname, $email, $password;

    public function __construct($id, $fullname, $email, $password){
        $this->id           = $id;
        $this->fullname     = $fullname;
        $this->email        = $email;
        $this->password     = $password;
    }

    public function getId(){
        return $this->id;
    }

    public function getFullname(){
        return $this->fullname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }
}

?>