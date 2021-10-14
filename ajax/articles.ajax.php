<?php

//
//publicando articulo
//

if (isset($_POST['title']) && isset($_POST['description'])) {

    if(!empty($_POST['title']) && !empty($_POST['description'])) {
        
        if (!preg_match('/^[,\\@\\?\\$\\.\\!\\¡\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/', $_POST['title'])) {
            echo 'title_invalido';
            exit();
        } else if (!preg_match('/^[,\\@\\?\\$\\.\\!\\¡\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/', $_POST['description'])) {
            echo 'description_invalido';
            exit();
        }

        $name_file = '';

        if ($_FILES['upPicture']['type'] == 'image/jpg' || $_FILES['upPicture']['type'] == 'image/png' || $_FILES['upPicture']['type'] == 'image/jpeg'){

            //  var_dump($_FILES['upPicture']);
    
            $iduser = trim(base64_decode($_POST['userid']));
            $extent = explode("/", $_FILES['upPicture']['type']);
            //  echo '<pre>'; print_r($extent); echo '</pre>';
    
            $name = explode("/", $_FILES['upPicture']['name']);
            //  echo '<pre>'; print_r($name); echo '</pre>';
    
            $name_picture = base64_decode($_POST['userid']).substr(time(),3).".".$extent[1];
    
            move_uploaded_file($_FILES['upPicture']['tmp_name'], '../images/users/' .$name_picture);
    
 
        }else {
            echo 'file_rechazado';
        }

    }else {
        echo 'campos_vacios';
    }

 


}