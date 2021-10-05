<?php
//incluimos la conexion a la base de datos.
require_once '../db_conexion.php';

if (isset($_POST['user_name']) && isset($_POST['email'])) {

    if ($_POST['email'] !== '' && $_POST['user_name']  !== '' && $_POST['password'] !== '') {

        if (!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $_POST['email'])) {
            echo  'email_invalido';
            exit();
        } else if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['user_name'])) {
            echo 'user_name_invalido';
            exit();
        } else if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['password'])) {
            echo 'password_invalido';
            exit();
        }
        //creamos variables el registro del usuario
        $email = $_POST['email'];
        $user =  $_POST['user_name'];
        $password =  $_POST['password'];
        $description = '';
        $picture = '';
        $banner = '';
        //0 es para indicar que la cuenta va estar desactivada
        $status = 0 ;
        $token = md5($_POST['email']);

        //prepara una nueva insercion al sql
        $stmt = $conn->prepare("INSERT INTO users(user_name, email, password, description, picture,  banner , status, token) VALUES(?,?,?,?,?,?,?,?)");
        
        /* ligar parámetros para marcadores */
        $stmt->bind_param("ssssssis", $user, $email, $password, $description, $picture, $banner, $status, $token);

        /* ejecutar la consulta */
        
        if ($stmt->execute()){
            echo 'ok';
        }else{
            echo'error';
        }
        //cerrar sentencia
        $stmt->close();

    } else {
        echo 'campos vacios';
    }
}
