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
      "& iduser=" + iduser
  );
}

/**
 *  subiendo imagen de perfil
 * */
 function upload_picture() {
   //en esta funcion se va agregar jquery
   var frmP = new FormData ($('#frmPicture')[0])
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

     }
   });
 
}

/**
 *  subiendo banner de perfil
 * */

function upload_banner() {
  //en esta funcion se va agregar jquery
  var frmBanner = new FormData ($('#frmBanner')[0])
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

    }
  });

}



/**
 *  validacion formulario de login
 * */
// Esta otro forma usar el evento click
document.querySelector(".login_ajax").addEventListener("click", function () {
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
