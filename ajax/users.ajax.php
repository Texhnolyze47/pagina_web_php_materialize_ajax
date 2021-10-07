<?php
//incluimos la conexion a la base de datos.
require_once '../db_conexion.php';

if (isset($_POST['user_name']) && isset($_POST['email'])) {

    if ($_POST['email'] !== '' && $_POST['user_name']  !== '' && $_POST['password'] !== '') {
        //comproba si las caracteres utilizados en email, username o passowrd no son validos
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
        $password =  md5($_POST['password']); //md5 se para encriptar datos
        $description = '';
        $picture = '';
        $banner = '';
        //0 es para indicar que la cuenta va estar desactivada
        $status = 0;
        $token = md5($_POST['email']);
        //sprinf regresa un string formateado

        /*Es es bloque se encarga de que el usuario y correo no puede repetir en la base de datos */
        $consulta = sprintf("SELECT * FROM `users` WHERE user_name = %s", limpiar($user, "text"));
        $result = mysqli_query($conn, $consulta);
        $row_cnt = mysqli_num_rows($result);

        if ($row_cnt == 0) {

            $consulta_e = sprintf("SELECT * FROM `users` WHERE email = %s", limpiar($email, "text"));
            $result_e = mysqli_query($conn, $consulta_e);
            $row_cnt_e = mysqli_num_rows($result_e);

            if ($row_cnt_e == 0) {

                //prepara una nueva insercion al sql
                $stmt = $conn->prepare("INSERT INTO users(user_name, email, password, description, picture,  banner , status, token) VALUES(?,?,?,?,?,?,?,?)");

                /* ligar parámetros para marcadores */
                $stmt->bind_param("ssssssis", $user, $email, $password, $description, $picture, $banner, $status, $token);

                /* ejecutar la consulta */

                if ($stmt->execute()) {
                    //envio de email confirmacion
                    $para = $email;
                    $titulo = "Verifique su correo eletronico";
                    $mensaje = "Utilice este enlace" . url . "verificar/" . $token . "Para verficar su cuenta";


                    // Para enviar un correo HTML, debe establecerse la cabecera Content-type
                    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    // Cabeceras adicionales
                    $cabeceras .= 'From: Sistema de usuarios <acnologiadust007@gmail.com>' . "\r\n";

                    // Enviarlo
                    mail($para, $titulo, $mensaje, $cabeceras);


                    echo 'ok';
                } else {
                    echo 'error';
                }
                //cerrar sentencia
                $stmt->close();
            } else {
                echo 'email_existe';
            }
            mysqli_free_result($result_e);
        } else {
            echo "user_existe";
        }

        mysqli_free_result($result);
    } else {
        echo 'campos_vacios';
    }
}

// 
// Validando datos login
// 

if (isset($_POST['fr_login']) & isset($_POST['user_name']) && isset($_POST['password'])) {

    if ($_POST['user_name']  !== '' && $_POST['password'] !== '') {

        if (!preg_match('/^[a-zA-Z0-9\\@\\.\\_]+$/', $_POST['user_name'])) {
            echo 'user_name_invalido';
            exit();
        } else if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['password'])) {
            echo 'password_invalido';
            exit();
        }
        //creamos variables el registro del usuario
        $user =  $_POST['user_name'];
        $password =  md5($_POST['password']); //md5 se para encriptar datos
    } else {
        echo 'campos_vacios';
    }
}
