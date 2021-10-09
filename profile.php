<?php include('header.php');

$iduser = $_SESSION['id'];
$consulta = sprintf(
    "SELECT * FROM users WHERE id = %s",
    limpiar($iduser, "int")
);
$result = mysqli_query($conn, $consulta);
$fech = mysqli_fetch_assoc($result);

?>
<!--=====================================
	profile
	======================================-->

<main role="main" class="user-profile">
    <div class="parallax-container profile">
        <div class="parallax">
            <?php
            if ($fech['banner'] == '') : ?>
                <img src="images/hero.jpg">
            <?php else : ?>
                <img src="<?php echo url . 'images/banners/' . $fech['banner']; ?> width=" 100" class="circle responsive-img">
            <?php endif ?>
        </div>

        <div class="content-parallax center">
            <figure>
                <?php
                if ($fech['picture'] == '') : ?>
                    <img src="images/persona.jpg" width="100" class="circle responsive-img">
                <?php else : ?>
                    <img src="<?php echo url . 'images/users/' . $fech['picture']; ?>images/persona.jpg" width="100" class="circle responsive-img">
                <?php endif ?>
            </figure>
            <h2 class="name-user">
                <?php echo $fech['user_name']; ?>
            </h2>
        </div>
    </div>
    <!--End of parallax-->

    <div class="container">
        <article class="center">
            <h3>Sobre mi</h3>
            <figcaption>
                <?php echo $fech['description']; ?>

            </figcaption>
        </article>

        <div class="articles-post-user-profile">
            <div class="row">
                <div class="col s12 m4 ">
                    <div class="card">
                        <div class="card-image scalar">
                            <a href="#!">
                                <img src="images/hero.jpg">
                            </a>

                        </div>
                        <div class="card-content">
                            <div class="author right">
                                <a href="#!">
                                    <img src="images/persona.jpg" width="60" class="circle responsive-img ">
                                </a>
                            </div><!-- End author-->

                            <a href="#!">
                                <span class="card-title">Nuevo articulo</span>
                            </a>
                            <p>I am a very simple card. I am good at containing small bits of information.
                                I am convenient because I require little markup to use effectively.</p>

                            <div class="card-footer">
                                <a href="#!" class="tooltipped" data-position="top" data-tooltip="Comentarios: 200">
                                    <i class="material-icons">comment</i>
                                </a>

                                <a href="#!" class="tooltipped" data-position="top" data-tooltip="Visitas: 1500">
                                    <i class="material-icons">group</i>
                                </a>
                            </div>
                        </div>
                    </div><!-- End card-->
                </div>
                <div class="col s12 m4 ">
                    <div class="card">
                        <div class="card-image scalar">
                            <a href="#!">
                                <img src="images/hero.jpg">
                            </a>

                        </div>
                        <div class="card-content">
                            <div class="author right">
                                <a href="#!">
                                    <img src="images/persona.jpg" width="60" class="circle responsive-img ">
                                </a>
                            </div><!-- End author-->

                            <a href="#!">
                                <span class="card-title">Nuevo articulo</span>
                            </a>
                            <p>I am a very simple card. I am good at containing small bits of information.
                                I am convenient because I require little markup to use effectively.</p>

                            <div class="card-footer">
                                <a href="#!" class="tooltipped" data-position="top" data-tooltip="Comentarios: 200">
                                    <i class="material-icons">comment</i>
                                </a>

                                <a href="#!" class="tooltipped" data-position="top" data-tooltip="Visitas: 1500">
                                    <i class="material-icons">group</i>
                                </a>
                            </div>
                        </div>
                    </div><!-- End card-->
                </div>
                <div class="col s12 m4 ">
                    <div class="card">
                        <div class="card-image scalar">
                            <a href="#!">
                                <img src="images/hero.jpg">
                            </a>

                        </div>
                        <div class="card-content">
                            <div class="author right">
                                <a href="#!">
                                    <img src="images/persona.jpg" width="60" class="circle responsive-img ">
                                </a>
                            </div><!-- End author-->

                            <a href="#!">
                                <span class="card-title">Nuevo articulo</span>
                            </a>
                            <p>I am a very simple card. I am good at containing small bits of information.
                                I am convenient because I require little markup to use effectively.</p>

                            <div class="card-footer">
                                <a href="#!" class="tooltipped" data-position="top" data-tooltip="Comentarios: 200">
                                    <i class="material-icons">comment</i>
                                </a>

                                <a href="#!" class="tooltipped" data-position="top" data-tooltip="Visitas: 1500">
                                    <i class="material-icons">group</i>
                                </a>
                            </div>
                        </div>
                    </div><!-- End card-->
                </div>
            </div>
        </div>
    </div>
</main>


<div class="fixed-action-btn">
    <a class="btn-floating btn-large red">
        <i class="large material-icons">mode_edit</i>
    </a>
    <ul>

        <li><a class="btn-floating green modal-trigger" href="#newPost"><i class="material-icons">create</i></a></li>
        <li><a class="btn-floating blue modal-trigger " href="#editDates"><i class="material-icons">person</i></a></li>
    </ul>
</div>

<!-- modal edit user -->

<!-- Modal Structure -->
<div id="editDates" class="modal">
    <div class="modal-content">
        <div class="center">
            <h4>Editando datos de perfil</h4>

            <form onsubmit="return false" class="editUser">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input type="text" id="up_username" readonly value="<?php echo $fech ['user_name']; ?>" class="validate">
                        <label for="up_username">Usuario</label>
                    </div>
                    <!--End col -->

                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input type="email" id="up_email" readonly value="<?php echo $fech ['email']; ?>" class="validate">
                        <label for="up_email">Email</label>
                    </div>
                    <!--End col -->

                    <div class="input-field col s12">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea id="description" class="materialize-textarea"><?php echo $fech ['description']; ?></textarea>
                        <label for="description">Descripcion</label>
                    </div>
                    <!--End col -->
                    <!-- se encripta el id -->
                    <input type="hidden" id="iduser" value="<?php echo base64_encode($fech['id']); ?>">
                    <div class="col s12">
                        <div class="center">
                            <button type="submit" class="waves-effect waves-light  btn grey" onclick="update_user();">
                                Actualizar datos
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>


<!-- Modal Structure -->
<div id="newPost" class="modal">
    <div class="modal-content">
        <h4>Agregando post</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>


<<?php
    include('footer.php');
    mysqli_free_result($result);
    ?>