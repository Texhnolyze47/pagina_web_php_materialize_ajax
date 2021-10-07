<?php 

require_once 'db_conexion.php';

// para salir de la sesion
$_SESSION['id'] = null;
$_SESSION['username'] = null;
//debido a tenemos un session_start en la db_conexion debemos destruir la sesion
session_destroy();

//para redirigir al usuario
header('Location:'.url);
//se corta la ejecucion al presionar el boton
exit();
