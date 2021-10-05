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
				<div class="container-form">
                    <div class="card">
                        <form onsubmit="return false">
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="icon_prefix" type="text" id="username" class="validate">
                                    <label for="icon_prefix">Ingresa tu Usuario o Email</label>
                                </div><!--End col -->

                                <div class="input-field col s12">
                                    <i class="material-icons prefix">password</i>
                                    <input id="icon_prefix" type="password" id="password" class="validate">
                                    <label for="icon_prefix">Contraseña</label>
                                </div><!--End col -->
                                <div class="col s12">
                                    <div class="center">
                                        <input type="submit" class="waves-effect waves-light  btn grey" value="Registrarme">
                                    </div>
                                </div>
                            </div><!--End row -->
                    </form>
                    </div>
                </div>
				
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