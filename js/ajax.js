/**
 *  validacion formulario de registro
 * */

function register() {
  //se extraen los datos del php y se guardan en variables

  var rg_username = document.querySelector("#rg_username").value;
  var rg_email = document.querySelector("#rg_email").value;
  var rg_pass1 = document.querySelector("#rg_pass1").value;
  var rg_pass2 = document.querySelector("#rg_pass2").value;

  //expresion regulares para los campos del formulario

  email_expresion = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
  expresion = /^[a-zA-Z0-9]+$/;

  //comprobaciones de que se  introdujeron los datos de forma correcta

  if (rg_username == "") {
    M.toast({ html: "El campo usuario no puede estar vacio" });

    /*estos return son para evitar que se llamen a todas las alertas
        y que no se envien el ajax.js al servidor a menos que esten todos
        los campos llenos */

    return;
  } else if (!expresion.exec(rg_username)) {
    M.toast({
      html: "En el campo de usuario, no se permiten caracteres especiales ni  espacios",
    });
    return;
  }

  if (rg_email == "") {
    M.toast({ html: "El campo email no puede estar vacio" });
    return;
  } else if (!email_expresion.exec(rg_email)) {
    M.toast({ html: "Por favor introduce un email válido" });
    return;
  }

  if (rg_pass1 == "" || rg_pass2 == "") {
    M.toast({ html: "El campo contraseña no puede estar vacio" });
    return;
  } else if (!expresion.exec(rg_pass1) || !expresion.exec(rg_pass2)) {
    M.toast({
      html: "En el campo de contraseña, no se permiten caracteres especiales ni  espacios",
    });
    return;
  }

  if (rg_pass1 !== rg_pass2) {
    M.toast({ html: "Las contraseñas no coinciden " });
    return;
  }

  var ajax = new XMLHttpRequest();
  var URL = "ajax/users.ajax.php";
  var method = "POST";

  ajax.onreadystatechange = function () {
    if (ajax.readyState == 4 && ajax.status == 200) {
      var response = ajax.responseText;

      if (response == "email_invalido") {
        M.toast({ html: "El email enviado no es válido" });
      } else if (response == "email_invalido") {
        M.toast({ html: "El email enviado no es válido" });
      } else if (response == "user_name_invalido") {
        M.toast({ html: "El usuario enviado no es válido" });
      } else if (response == "password_invalido") {
        M.toast({ html: "La contraseña enviada no es válida" });
      } else if (response == "campos vacios") {
        M.toast({ html: "Algunos de los campos envíados están vacios" });
      } else if (response == "ok") {
        //se manda un aviso de que realizo el registro con exito
        M.toast({
          html:
            "Su resgistro se realizo correctamente, por favor verifique su cuenta ," +
            rg_email +
            ",para ingresar",
        });
        //se limpian los datos del formulario
        document.getElementById("form_r").reset();
      } else if (response == "user_existe") {
        M.toast({
          html: "El usuario ya se encuentra registrado, intente con uno diferente",
        });
      } else if (response == "email_existe") {
        M.toast({
          html: "El email ya se encuentra registrado, intente con uno diferente",
        });
      }
    }
  };

  ajax.open(method, URL, true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send(
    "user_name=" +
      rg_username +
      "& email=" +
      rg_email +
      "& password=" +
      rg_pass1
  );
}

/**
 *  validacion formulario de registro
 * */
function update_user() {
  //se extraen los datos del php y se guardan en variables
  var up_username = document.querySelector("#up_username").value;
  var up_email = document.querySelector("#up_email").value;
  var description = document.querySelector("#description").value;
  var iduser = document.querySelector("#iduser").value;

  //expresion regulares para los campos del formulario
  email_expresion = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
  expresion = /^[a-zA-Z0-9]+$/;
  exp_description = /^[,\\@\\?\\$\\.\\!\\¡\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/;

  //comprobaciones de se introdujeron los datos de forma correcta

  if (up_username == "") {
    M.toast({ html: "El campo usuario no puede estar vacio" });
    /*estos return son para evitar que se llamen a todas las alertas
        y que no se envien el ajax.js al servidor a menos que esten todos
        los campos llenos */
    return;
  } else if (!expresion.exec(up_username)) {
    M.toast({
      html: "En el campo de usuario, no se permiten caracteres especiales ni  espacios",
    });
    return;
  }

  if (up_email == "") {
    M.toast({ html: "El campo email no puede estar vacio" });
    return;
  } else if (!email_expresion.exec(up_email)) {
    M.toast({ html: "Por favor introduce un email válido" });
    return;
  }

  if (description == "") {
    M.toast({ html: "El campo descripcion no puede estar vacio" });
    return;
  } else if (!exp_description.exec(description)) {
    M.toast({
      html: "En el campo de descripcion, no se permiten algunos caracteres especiales ni espacios",
    });
    return;
  }

  var ajax = new XMLHttpRequest();
  var URL = "ajax/users.ajax.php";
  var method = "POST";

  ajax.onreadystatechange = function () {
    if (ajax.readyState == 4 && ajax.status == 200) {
      var response = ajax.responseText;

      if (response == "ok") {
        M.toast({ html: "Su perfil se actualizo correctamente" });
        //esto hace que recargue la pagina
        window.location.reload();
      } else if (response == "email_invalido") {
        M.toast({ html: "El email enviado no es válido" });
      } else if (response == "user_name_invalido") {
        M.toast({ html: "El usuario enviado no es válido" });
      } else if (response == "description_invalido") {
        M.toast({ html: "La descripcion enviada no es válida" });
      } else if (response == "campos_vacios") {
        M.toast({ html: "Algunos de los campos enviados están vacios" });
      }
    }
  };

  ajax.open(method, URL, true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send(
    "up_username=" +
      up_username +
      "& up_email=" +
      up_email +
      "& description=" +
      description +
      "& iduser=" +
      iduser
  );
}

/**
 *  subiendo imagen de perfil
 * */
function upload_picture() {
  //en esta funcion se va agregar jquery
  var frmP = new FormData($("#frmPicture")[0]);
  $.ajax({
    type: "POST",
    url: "ajax/users.ajax.php",
    data: frmP,
    contentType: false,
    processData: false,
    success: function (response) {
      M.toast({ html: "Foto actualizada" });
      //  $('#frmPicture')[0].reset();
      //  $('refreshp').attr('src', response);
      location.reload();
    },
  });
}

/**
 *  subiendo banner de perfil
 * */

function upload_banner() {
  //en esta funcion se va agregar jquery
  var frmBanner = new FormData($("#frmBanner")[0]);
  $.ajax({
    type: "POST",
    url: "ajax/users.ajax.php",
    data: frmBanner,
    contentType: false,
    processData: false,
    success: function (response) {
      M.toast({ html: "Banner actualizado" });
      // $('#frmBanner')[0].reset();
      // $('.refresB').attr('src', response);
      location.reload();
    },
  });
}

/**
 *  Paginacion
 * */
$(".show_cascade").on("click", function () {
  let value = $(".paginate").attr("cargar");
  $.ajax({
    url: "ajax/articles.ajax.php",
    type: "POST",
    data: "cascade_page=" + value,
    cache: false,
    processData: false,
    dataType: "json",
    beforeSend: function(){
      //muestra la barra de carga
      $('.progress_paginate').show();
    },
    success: function (data) {
      if (data["error"] == "error") {
        $('.progress_paginate').fadeOut(600);
        $('.show_cascade').fadeOut(600);
        M.toast({ html: "No se encontraron mas articulos" });

      } else {
        $('.progress_paginate').slideUp(600);

        data.forEach(funcionForEach);
        function funcionForEach(item, index) {
          console.log("item", item);
          //variables del contenido del articulo
          var titulo = item[1].substr(0,120),
          description = item[2],
          imagen =  item[3],
          ruta = item[4],
          visitas = item[6],
          comentarios = [7],
          picture = item[14],
          usuario = item[10];

          if (picture != '') {
            var picture = url + "images/users/" + item[14]
          }else{
            var picture = url + "images/persona.jpg";
          }

          if (imagen != '') {
            var image = url + "images/articles/" + item[3]
          }else{
            var image = url + "images/hero.jpg";
          }
          $("#cascade_articles .row")
            .append(
              `                    
                  <div class="col s12 m4 ">
                <div class="card">
                    <div class="card-image scalar">
                        <a href="#!" class="modal-trigger" data-target="open_modal" onclick="open_modal_item('${ruta}');">
                       
                                <img src="${image}" >
                           
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="author right">
                            <a href="#!">
                                <img src="${picture}" width="60"  class="circle">

                            </a>
                        </div><!-- End author-->

                        <a href="#!">
                            <span class="card-title modal-trigger" data-target="open_modal" onclick="open_modal_item('${ruta}')">${titulo}</span>
                        </a>
                        <!--  substr hace que se extraiga un porcion del texto-->
                        <p>${description}</p>
                        <div class="card-footer">
                            <a href="#!" class="tooltipped" data-position="top" data-tooltip="Comentarios: ${comentarios}">
                                <i class="material-icons">comment</i>
                            </a>

                            <a href="#!" class="tooltipped" data-position="top" data-tooltip="Visitas: ${visitas}">
                                <i class="material-icons">group</i>
                            </a>
                        </div>
                    </div>
                </div><!-- End card-->
            </div>`
            );
        }
        $(".tooltipped").tooltip();
      }
    },
  });
});

/**
 *  validacion formulario de articulo
 * */

function add_post() {
  //se extraen los datos del php y se guardan en variables

  var title = document.querySelector("#title").value;
  var description = document.querySelector("#description").value;

  //expresion regulares para los campos del formulario

  exp = /^[,\\@\\?\\$\\.\\!\\¡\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/;

  //comprobaciones de que se  introdujeron los datos de forma correcta

  if (title == "") {
    M.toast({ html: "El campo titulo no puede estar vacio" });

    return;
  } else if (!exp.exec(title)) {
    M.toast({
      html: "En el campo de titulo, no se permiten algunos caracteres especiales",
    });
    return;
  }

  if (description == "") {
    M.toast({ html: "El campo descripcion no puede estar vacio" });
    return;
  } else if (!exp.exec(description)) {
    M.toast({
      html: "En el campo de descripcion, no se permiten algunos caracteres especiales",
    });
    return;
  }

  var formD = new FormData($("#newArticle")[0]);
  $.ajax({
    type: "POST",
    url: "ajax/articles.ajax.php",
    data: formD,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == "ok") {
        M.toast({ html: "Articulo agregado correctamnte" });
        $("#newArticle")[0].reset();
      }
    },
  });
}

/**
 *  validacion formulario de login
 * */
// Esta otro forma usar el evento click
$(".login_ajax").on("click", function () {
  //se extraen los datos del php y se guardan en variables
  var lg_username = document.querySelector("#lg_username").value;
  var lg_password = document.querySelector("#lg_password").value;
  var fr_login = "ok";
  //expresion regulares para los campos del formulario
  expresion = /^[a-zA-Z0-9\\@\\.\\_]+$/;
  //comprobaciones de se introdujeron los datos de forma correcta
  if (lg_username == "") {
    M.toast({ html: "El campo usuario no puede estar vacio" });
    /*estos return son para evitar que se llamen a todas las alertas
        y que no se envien el ajax.js al servidor a menos que esten todos
        los campos llenos */
    return;
  } else if (!expresion.exec(lg_username)) {
    M.toast({
      html: "En el campo de usuario, no se permiten caracteres especiales ni espacios",
    });
    return;
  }

  if (lg_password == "") {
    M.toast({ html: "El campo contraseña no puede estar vacio" });
    return;
  } else if (!expresion.exec(lg_password)) {
    M.toast({
      html: "En el campo de contraseña, no se permiten caracteres especiales ni  espacios",
    });
    return;
  }

  var ajax = new XMLHttpRequest();
  var URL = "ajax/users.ajax.php";
  var method = "POST";

  ajax.onreadystatechange = function () {
    if (ajax.readyState == 4 && ajax.status == 200) {
      var response = ajax.responseText;

      if (response == "user_name_invalido") {
        M.toast({ html: "El usuario o email enviado no es válido" });
      } else if (response == "password_invalido") {
        M.toast({ html: "La contraseña enviada no es válida" });
      } else if (response == "campos vacios") {
        M.toast({ html: "Algunos de los campos envíados están vacios" });
      } else if (response == "ok") {
        //si todo esta bien se redirige a perfil
        window.location = "perfil";
      } else if (response == "no_existe") {
        M.toast({
          html: "El usuario y/o contraseña incorrectos",
        });
      }
    }
  };

  ajax.open(method, URL, true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send(
    "user_name=" +
      lg_username +
      "& password=" +
      lg_password +
      "& fr_login=" +
      fr_login
  );
});


/**
 *  Mostrando informacion de articulos
 * */

function open_modal_item(value){
  $.ajax({
    type: "post",
    url: url + "inc/item.php",
    data: 'value=' + value,
    success: function (response) {
      $('.res_modal').html(response);
    }
  });
}