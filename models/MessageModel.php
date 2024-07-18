<?php

class MessageModel {
   
    public $email;
    public $subject;
    public $message;

    function __construct($subject, $message, $email)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

}

?>