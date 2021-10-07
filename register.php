<?php 
	include('header.php');
?>
	<!--=====================================
	Hero
	======================================-->

	<section class="section-hero">
		<div class="hero">
			<div class="container">
				<div class="container-form">
					<div class="card">
						<form onsubmit="return false" id="form_r">
							<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">account_circle</i>
									<input type="text" id="rg_username" class="validate">
									<label for="rg_username">Usuario</label>
								</div>
								<!--End col -->

								<div class="input-field col s12">
									<i class="material-icons prefix">email</i>
									<input type="email" id="rg_email" class="validate">
									<label for="rg_email">Email</label>
								</div>
								<!--End col -->

								<div class="input-field col s12">
									<i class="material-icons prefix">password</i>
									<input  type="password" id="rg_pass1" class="validate">
									<label for="rg_pass1">Contraseña</label>
								</div>
								<!--End col -->

								<div class="input-field col s12">
									<i class="material-icons prefix">lock</i>
									<input  type="password" id="rg_pass2" class="validate">
									<label for="rg_pass2">Verificar contraseña</label>
								</div>
								<!--End col -->
								<div class="col s12">
									<div class="center">
										<button type="submit" class="waves-effect waves-light  btn grey" onclick="register();">
											Registrarme
										</button>
									</div>
								</div>
							</div>
							<!-- En caso de que ya este la cuenta en la base de datos -->
							<div class="col s12">
								<div class="center pt-2">
									<a href="<?php echo url; ?>login" class="black-text" >Ya tengo una cuenta</a>
								</div>
							</div>

							<!--End row -->
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>

<?php
	include('footer.php');
?>