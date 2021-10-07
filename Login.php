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
                    <form onsubmit="return false" id="formL">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input type="text" id="lg_username" class="validate">
                                <label for="username">Ingresa tu Usuario o Email</label>
                            </div>
                            <!--End col -->

                            <div class="input-field col s12">
                                <i class="material-icons prefix">password</i>
                                <input type="password" id="lg_password" class="validate">
                                <label for="password">Contraseña</label>
                            </div>
                            <!--End col -->
                            <div class="col s12">
                                <div class="center">
                                    <input type="submit" class="waves-effect waves-light btn grey login_ajax" value="Ingresar">
                                </div>
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