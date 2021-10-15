<?php
// Es archivo que encarga de dar un tratamiento  los datos que recibe
function limpiar($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{

    global $conn;

    $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conn, $theValue) : mysqli_escape_string($conn, $theValue);

    switch ($theType) {
        case "text":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "long":
        case "int":
            $theValue = ($theValue != "") ? intval($theValue) : "NULL";
            break;
        case "double":
            $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
            break;
        case "date":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "defined":
            $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;
    }
    return $theValue;
}
//Esta una ruta absoluta para puedan localizar los datos
define('url', 'http://localhost/sistema-usuarios/');

/*=============================================
FORMATEAR URL
=============================================*/

function limpiar_url($url) {
    // Tranformamos todo a minusculas
    $url = strtolower($url);
    //Rememplazamos caracteres especiales latinos
    $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
    $repl = array('a', 'e', 'i', 'o', 'u', 'n');
    $url = str_replace ($find, $repl, $url);
    // Añadimos los guiones
    $find = array(' ', '&', '\r\n', '\n', '+'); 
    $url = str_replace ($find, '-', $url);
    // Eliminamos y Reemplazamos demás caracteres especiales
    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
    $repl = array('', '-', '');
    $url = preg_replace ($find, $repl, $url);
    
    return $url;
  }

  /*=============================================
Mostrat articulos
=============================================*/

function all_articules($limit){
    //con global podemos llamar  a la base de datos dentro de una funcion
    global$conn;
    // join es una forma de unir las dos tablas
    $stmt = $conn->prepare("SELECT * FROM article JOIN users ON users.id = article.author ORDER BY article.id DESC LIMIT $limit"); 
    $stmt -> execute();
    // Va mostar todos los articulos dentro de la base de datos
    return $stmt -> get_result();
    $stmt -> close();
}

