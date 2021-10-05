<?php

if (isset($_POST['user_name']) && isset($_POST['email'])) {
    
    if(!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $_POST["email"])){
        echo "Email_invalido";
    }

    echo$_POST['email'];  
}