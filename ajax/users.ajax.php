<?php
// Este archivo se encarga de validar la informacion 
// que recibe del form y al comprobar que todo esta correcto 
// lo envia a la base de datos

//incluimos la conexion a la base de datos.
require_once '../db_conexion.php';

// 
// Registro


if (isset($_POST['user_name']) && isset($_POST['email'])) {

    if ($_POST['email'] !== '' && $_POST['user_name']  !== '' && $_POST['password'] !== '') {
        //comproba si las caracteres utilizados en email, username o password no son validos
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
                    $titulo = "Verifique su correo electronico";
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


        //se pregunta a la base de datos por los usuarios
        $consulta = sprintf("SELECT * FROM `users` WHERE user_name = %s AND password = %s AND status > 0 OR email = %s AND password = %s AND status > 0", 
        limpiar($user, "text"),
        limpiar($password, "text"),
        limpiar($user, "text"),
        limpiar($password, "text"));
        
        $result = mysqli_query($conn, $consulta);
        $fech = mysqli_fetch_assoc($result);
        $row_cnt = mysqli_num_rows($result);
        
        if($row_cnt == 1){

            // session_start();
            $_SESSION['id'] = $fech['id'];
            $_SESSION['username'] = $fech['user_name'];
            echo "ok";

        }else{
            echo "no_existe";
        }

        mysqli_free_result($result);


    } else {
        echo 'campos_vacios';
    }
}


// 
// Validando datos actualizar de perfil
// 

// si el usuario, email y descripcion existen se ejecutara el if
if (isset($_POST['up_username']) && isset($_POST['up_email']) && isset($_POST['description'])) {
    //si alguno de los campos estan vacios se enviara el echo campos_vacios
    if ($_POST['up_username']  !== '' && $_POST['up_email'] !== '' && $_POST['description']  !==  '') {
        //esto valida a los diferentes campos en caso que tenga algun carácter invalido se enviara el echo dentro del bloque 
        if (!preg_match('/^[a-zA-Z0-9\\@\\.\\_]+$/', $_POST['up_username'])) {
            echo  'user_name_invalido';
            exit();
        }else if (!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $_POST['up_email'])) {
            echo 'email_invalido';
            exit();
            //cuidado con los espacios en las expresiones regulares
        }else if (!preg_match('/^[,\\@\\?\\$\\.\\!\\¡\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/', $_POST['description'])) {
            echo 'description_invalido';
            exit();
        }
        $iduser =  base64_decode($_POST['iduser']);
        $user = $_POST['up_username'];
        $email = $_POST['up_email'];
        $description = $_POST['description'];

        $stmt = $conn->prepare("UPDATE users SET user_name = ?, email = ?, description = ? WHERE id = ? ");

        /* ligar parámetros para marcadores */
        $stmt->bind_param("sssi", $user , $email, $description, $iduser);

        if($stmt->execute()){
            echo 'ok';
        }else {
            echo 'error';
        }
       
        $stmt -> close();
        
    } else {
        echo 'campos_vacios';
    }
}


// 
// Subiendo imagen de perfil
// 
if(isset($_FILES['upPicture'])){
    if ($_FILES['upPicture']['type'] == 'image/jpg' || $_FILES['upPicture']['type'] == 'image/png' || $_FILES['upPicture']['type'] == 'image/jpeg'){

        //  var_dump($_FILES['upPicture']);

        $iduser = trim(base64_decode($_POST['userid']));
        $extent = explode("/", $_FILES['upPicture']['type']);
         echo '<pre>'; print_r($extent); echo '</pre>';

        $name = explode("/", $_FILES['upPicture']['name']);
         echo '<pre>'; print_r($name); echo '</pre>';

        $name_picture = base64_decode($_POST['userid']).".".$extent[1];

        move_uploaded_file($_FILES['upPicture']['tmp_name'], '../images/users/' .$name_picture);

        //consulta al servidor
        $stmt = $conn->prepare("UPDATE users SET picture = ? WHERE id = ? ");
        
        $stmt->bind_param("si", $name_picture , $iduser);

        if($stmt->execute()){
            echo "images/users/".$name_picture;
        }else {
            echo 'error';
        }
       
        $stmt -> close();
        

    }else {
        echo 'file_rechazado';
    }
}

// 
// Subiendo banner de perfil
// 
// se pregunta si existe el archivo
if(isset($_FILES['upBanner'])){
        //  var_dump($_FILES['upBanner']);

    //si cumple con las extensiones se ejecuta el cuerpo de la funcion
    if ($_FILES['upBanner']['type'] == 'image/jpg' || $_FILES['upBanner']['type'] == 'image/png' || $_FILES['upBanner']['type'] == 'image/jpeg'){

        // descriptar el id del user
        $iduser = trim(base64_decode($_POST['userid']));

        $extent = explode('/', $_FILES['upBanner']['type']);

        //se crea el nombre de la imagen
        $name_banner = base64_decode($_POST['userid']).".".$extent[1];
        //se mueve la imagen al directorio
        move_uploaded_file($_FILES['upBanner']['tmp_name'], '../images/banners/' .$name_banner);

        //consulta al servidor
        $stmt = $conn->prepare("UPDATE users SET banner = ? WHERE id = ? ");
        
        $stmt->bind_param("si", $name_banner , $iduser);

        if($stmt->execute()){
            echo "images/banners/".$name_banner;
        }else {
            echo 'error';
        }
       
        $stmt -> close();
        

    }else {
        echo 'file_rechazado';
    }
}