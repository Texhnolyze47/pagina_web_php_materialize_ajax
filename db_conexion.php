<?php
//cambiar la contraseña qeu tiene por defecto el plugin auth_socket poer la contraseñá elegida
$conn = new mysqli("localhost", "root", "admin", "sistema_usuarios", 3306);
if ($conn->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    exit;
}



