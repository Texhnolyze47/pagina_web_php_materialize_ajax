<?php include('header.php');
// este es el numero maximo de articulos que se van a mostrar
$item = 6;

$items = all_articules($item);

?>
<!--=====================================
	profile
	======================================-->

<main role="main" class="user-profile">
    <div class="container">

        <div class="articles-post-user-profile">
            <div class="row">
                <?php foreach ($items as $key => $value) : ?>
                    <div class="col s12 m4 ">
                        <div class="card">
                            <div class="card-image scalar">
                                <a href="#!">
                                    <?php
                                    if ($value['images'] != '') : ?>
                                        <img src="<?php echo url . 'images/articles/' . $value['images']; ?>" >

                                    <?php else : ?>
                                        <img src="images/hero.jpg">
                                    <?php endif ?>

                                </a>

                            </div>
                            <div class="card-content">
                                <div class="author right">
                                    <a href="#!">
                                    <?php
                                    if ($value['picture'] != '') : ?>
                                        <img src="<?php echo url . 'images/users/' . $value['picture']; ?>" >

                                    <?php else : ?>
                                        <img src="images/persona.jpg" width="60" class="circle" >
                                    <?php endif ?>
                                    </a>
                                </div><!-- End author-->

                                <a href="#!">
                                    <span class="card-title"><?php echo $value['title']; ?></span>
                                </a>
                                <p><?php echo $value['description']; ?>
                                <div class="card-footer">
                                    <a href="#!" class="tooltipped" data-position="top" data-tooltip="Comentarios: <?php echo $value['comments']; ?>">
                                        <i class="material-icons">comment</i>
                                    </a>

                                    <a href="#!" class="tooltipped" data-position="top" data-tooltip="Visitas: <?php echo $value['visitors']; ?>">
                                        <i class="material-icons">group</i>
                                    </a>
                                </div>
                            </div>
                        </div><!-- End card-->
                    </div>

                <?php endforeach; ?>


            </div>
            <!--End row-->
            <div class="center">
                <a href="javascript:void(0)" class="waves-effect waves-light  btn grey">
                    Cargar más
                </a>
            </div>
        </div> <!-- End articles post user profiles-->
    </div><!-- End container-->
</main>


<?php include('footer.php');
?>