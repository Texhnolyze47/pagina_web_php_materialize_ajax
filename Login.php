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
                    <form onsubmit="return false">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="icon_prefix" type="text" id="username" class="validate">
                                <label for="icon_prefix">Ingresa tu Usuario o Email</label>
                            </div>
                            <!--End col -->

                            <div class="input-field col s12">
                                <i class="material-icons prefix">password</i>
                                <input id="icon_prefix" type="password" id="password" class="validate">
                                <label for="icon_prefix">Contraseña</label>
                            </div>
                            <!--End col -->
                            <div class="col s12">
                                <div class="center">
                                    <input type="submit" class="waves-effect waves-light  btn grey" value="Registrarme">
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