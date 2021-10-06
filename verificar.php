<?php
//este bloque sirve para verificar el correo electronico
    require_once 'db_conexion.php';
    if(isset($_GET['verificar'])){
        $token = $_GET['verificar'];
        $stmt =  $conn->prepare("UPDATE users SET status = 1 WHERE token = ?");
        $stmt->bind_param("s", $token);

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title></title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="apple-mobbile-web-app-capable" content="yes">
	<meta name="apple-mobbile-web-app-title" content="">

	<link rel="icon" href="images/logo.png">

	<!--=====================================
	Marcado HTML5
	======================================-->

	<meta name="title" content="USERS">
	<meta name="description" content="Administración de usuarios">
	<meta name="keyword" content="suers, perfil, web">
	<!--=====================================
	CSS STYLES
	=====================================-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/main.css">

	<!--=====================================
	JAVASCRIPT SCRIPTS
	======================================-->
	<script src="js/materialize.min.js"></script>
</head>

<body>
	<!--=====================================
	Header
	======================================-->
	<header class="navbar-fixed index-1">
		<nav class="blue-grey darken-1">
			<div class="container">
				<div class="nav-wrapper">
					<a href="#!" class="brand-logo left">
						<img src="images/logo.png" width="40" />
					</a>
					<a href="#" data-target="nav-movil" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li><a href="sass.html">Articulos</a></li>
						<li><a href="#!" class="waves-effect waves-light  btn grey">Registro</a></li>
					</ul>
				</div>
			</div>

		</nav>

		<ul class="sidenav" id="nav-mobil">
			<li><a href="sass.html">Articulos</a></li>
			<li><a href="badges.html" class="btn grey">Registro</a></li>
		</ul>
	</header>

	<!--=====================================
	Hero
	======================================-->

	<section class="section-hero">
		<div class="hero">
			<div class="container">
            //en caso de se verifique de forma correcta
                <?php if ($stmt->execute()): ?>
                    <div class="container-hero">
					<h2 class="title-hero">
						Bienvenido cuenta verificada
					</h2>
					<p>
						Su cuenta se a verificado puede ingresar
					</p>
					<a href="Login.php" class="waves-effect waves-light  btn grey">Ingresar</a>
				</div>
                //en caso de se verifique de forma incorrecta

                <?php else: ?>
                    <div class="container-hero">
					<h2 class="title-hero">
						Ocurrio un error al verificar su cuenta
					</h2>

					<a href="register.php" class="waves-effect waves-light  btn red">Registro</a>
				</div>
                <?php endif ?>
				
				
			</div>
		</div>
	</section>

	<footer class="black">
		<div class="container">
			<p class="copy">
				&copy; Todos los derechos reservados - sistemas de usuarios
			</p>
		</div>
	</footer>



	<div class="scrolltop scrolltop-dark"></div>
	<script src="js/app.js"></script>
	<script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>

<?php
//este bloque indica que solo se mostrara esta pagina si el usuario tiene su url correspondiente
$stmt->close();

    header('Locatin'.url);
    exit();


?>