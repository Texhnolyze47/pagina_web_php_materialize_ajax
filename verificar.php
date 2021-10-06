<?php
//este bloque sirve para verificar el correo electronico
require_once 'db_conexion.php';
if (isset($_GET['verificar'])) {
	$token = $_GET['verificar'];
	$stmt =  $conn->prepare("UPDATE users SET status = 1 WHERE token = ?");
	$stmt->bind_param("s", $token);
}
?>
<?php
include('footer.php');
?>

<!--=====================================
	Hero
	======================================-->

<section class="section-hero">
	<div class="hero">
		<div class="container">
			//en caso de se verifique de forma correcta
			<?php if ($stmt->execute()) : ?>
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

			<?php else : ?>
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

<?php
include('footer.php');
?>
<?php
//este bloque indica que solo se mostrara esta pagina si el usuario tiene su url correspondiente
$stmt->close();

header('Locatin' . url);
exit();


?>