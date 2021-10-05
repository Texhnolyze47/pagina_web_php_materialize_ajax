<?php

if (isset($_POST['user_name']) && isset($_POST['email'])) {

    if ($_POST['email'] !== '' && $_POST['user_name']  !== '' && $_POST['password'] !== '') {

        if (!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $_POST['email'])) {
            echo  'email_invalido' ;
            exit();
        } else if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['user_name'])) {
            echo 'user_name_invalido';
            exit();

        } else if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['password'])) {
            echo 'password_invalido';
            exit();

        }

        echo $_POST['email'] . '<br>';
        echo $_POST['user_name'] . '<br>';
        echo $_POST['password'] . '<br>';
    } else {
        echo 'campos vacios';
    }
}
