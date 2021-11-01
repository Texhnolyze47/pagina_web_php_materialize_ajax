<?php
require_once '../db_conexion.php';

if (isset($_POST['value'])) {
    if (!empty($_POST['value'])) {
        $url_post = $_POST['value'];
        $item = item_post($url_post);
        
    } else {
        echo "error";

        exit();
    }
} else {
    echo "error";

    exit();
}



?>
<div class="center">
    <?php if ($item['images'] !== '') : ?>
        <img src="<?php echo url . 'images/articles/' . $item['images']; ?>" class="responsive-img materialboxed">

    <?php endif; ?>
</div><!-- End file content -->



<div class="content-post pt-4">
    <h3><?php echo $item['title']; ?></h3>
    <p class="f1-8 date"><strong>Publicado:</strong><?php echo $item['created']; ?></p>

    <?php echo $item["description_a"]; ?>

</div><!-- End content-post -->

<div class="content-ahutor pt-4 pb-3">
    <p class="f2">Publicado por:</p>
    <div class="ahutor-flex">
        <div class="picture-img">

            <a href="#!" class="tooltipped" data-position="top" data-tooltip="<?php echo $item['user_name']; ?>">
                <?php if ($item['picture'] !== '') : ?>
                    <img src="<?php echo url . 'images/users/' . $item['picture'] ?>" alt="username" width="100" height="100" class="circle">
                <?php else : ?>
                    <img src="images/persona.jpg"  width="100" height="100" class="circle" >
                <?php endif ?>

            </a>
        </div>
        <div class="details-ahutor">
            <p class="ahutor-name"><?php echo $item['user_name']; ?></p>
            <p class="ahutor-review"><?php echo $item['description']; ?></p>
        </div>
    </div>
</div><!-- End conetent ahutor -->

<div class="divider"></div>
<div class="card-footer-item right">
    <a href="javascript:void(0)" class="tooltipped" data-position="top" data-tooltip="<?php echo $item['comments']; ?>">
        <i class="material-icons">comment</i>
    </a>

    <a href="javascript:void(0)" class="tooltipped" data-position="top" data-tooltip="<?php echo $item['visitors']; ?>">
        <i class="material-icons">groups</i>
    </a>
    <a href="javascript:void(0)" class="tooltipped" data-position="top" data-tooltip="Me gusta: 500">
        <i class="material-icons">thumb_up_alt</i>
    </a>

</div>

<div class="content-commnets pt-4 pb-4">
    <p class="f2">Comentarios</p>
    <div class="ahutor-flex">
        <div class="picture-img">
            <a href="#!" class="tooltipped" data-position="top" data-tooltip="DEMO">
                <img src="<?php echo url; ?>images/persona.jpg" alt="username" width="70" height="70" class="circle">
            </a>
        </div>
        <div class="details-ahutor">
            <p class="ahutor-name f1-4">Demo</p>
            <p class="ahutor-review f1-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus, numquam, laudantium accusantium illum at dolores! Voluptatibus quod vitae rerum, debitis suscipit, beatae dolorum aliquam, cum, sunt possimus nobis fugit enim.</p>
        </div>
    </div>
    <div class="divider"></div>

    <div class="commet_load"></div>


    <form onsubmit="return false" class="fmComment pt-4">
        <div class="input-field col s12">
            <i class="material-icons prefix">mode_edit</i>
            <textarea id="comment" name="comment" class="materialize-textarea"></textarea>
            <label for="description">Escribe un comentario</label>
        </div><!-- Enf col -->
        <input type="hidden" name="ahutor" value="<?php echo $_SESSION['id']; ?>" />

        <input type="hidden" name="picture" value="<?php echo url . 'images/person.png' ?>" />

        <input type="hidden" name="username" value="" />
        <input type="hidden" name="id_article" value="" />
        <input type="hidden" name="ahutor_article" value="" />

        <button class="red darken-2 btn" type="button" onclick="add_comment(comment.value, ahutor.value, picture.value, username.value, id_article.value, ahutor_article.value);">Comentar</button>
    </form>


</div><!-- End conetent commnets -->


<script>
    $('.tooltipped').tooltip();
    $('.materialboxed').materialbox();
</script>