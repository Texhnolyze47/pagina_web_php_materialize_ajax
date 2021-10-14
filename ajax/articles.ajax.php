<?php
require_once '../db_conexion.php';


//
//publicando articulo
//

if (isset($_POST['title']) && isset($_POST['description'])) {

    if (!empty($_POST['title']) && !empty($_POST['description'])) {

        if (!preg_match('/^[,\\@\\?\\$\\.\\!\\¡\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/', $_POST['title'])) {
            echo 'title_invalido';
            exit();
        } else if (!preg_match('/^[,\\@\\?\\$\\.\\!\\¡\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/', $_POST['description'])) {
            echo 'description_invalido';
            exit();
        }

        //Validando imagen
        $name_file = '';

        if ($_FILES['images_file']['type'] == 'image/jpg' || $_FILES['images_file']['type'] == 'image/png' || $_FILES['images_file']['type'] == 'image/jpeg') {

            //  var_dump($_FILES['images_file']);

            $iduser = trim(base64_decode($_POST['userid']));
            $extent = explode('/', $_FILES['images_file']['type']);
            //  echo '<pre>'; print_r($extent); echo '</pre>';
            $name_file = time().'-'.$_FILES['images_file']['name'];

            move_uploaded_file($_FILES['images_file']['tmp_name'], '../images/articles/' . $name_file);
        }

        $author = base64_decode($_POST['userid']);
        $title = $_POST['title'];
        $description = $_POST['description'];
        //esto va volver al titulo en una url amigable
        $url = limpiar_url($title);
        $visitors = 0;
        $comments = 0;
        //insertando datos

        //consulta al servidor

        //prepara una nueva insercion al sql
        $stmt = $conn->prepare("INSERT INTO article (title, description, images, url , author, visitors , comments) VALUES(?,?,?,?,?,?,?)");

        /* ligar parámetros para marcadores */
        $stmt->bind_param("sssssss", $title, $description, $name_file, $url, $author,  $visitors, $comments);


        if ($stmt->execute()) {
            echo 'ok';
        } else {
            echo 'error';
        }
    } else {
        echo 'campos_vacios';
    }
}
