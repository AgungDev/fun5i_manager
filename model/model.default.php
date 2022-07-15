<?php

namespace fun5i\manager\model;

class Models {

    private $error, $message, $result;

    public function __construct($error, $message, $result){
        $this->error         = $error;
        $this->message       = $message;
        $this->result        = $result;
    }

    public function getError(){
        return $this->error;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getResult(){
        return $this->result;
    }
}

?>