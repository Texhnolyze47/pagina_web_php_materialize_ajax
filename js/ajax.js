/**
 *  validacion formulario de registro
 * */
function register() {
    //se extraen los datos del php y se guardan en varaibles
    var rg_username = document.querySelector("#rg_username").value;
    var rg_email = document.querySelector("#rg_email").value;
    var rg_pass1 = document.querySelector("#rg_pass1").value;
    var rg_pass2 = document.querySelector("#rg_pass2").value;
    //expresion regulares para los campos del formulario
    email_exprecion = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    exprecion = /^[a-zA-Z0-9]+$/;
    //comprobaciones de se introduccieron los datos de forma correcta
    if (rg_username == "") {
        M.toast({ html: "El campo usuario no puede estar vacio" });
    } else if (!exprecion.exec(rg_username)) {
        M.toast({
            html: "En el campo de usuario, no se permiten carácteres especiales ni  espacios",
        });
    }

    if (rg_email == "") {
        M.toast({ html: "El campo email no puede estar vacio" });
    } else if (!email_exprecion.exec(rg_email)) {
        M.toast({ html: "Por favor introduce un email válido" });
    }

    if (rg_pass1 == "") {
        M.toast({ html: "El campo contraseña no puede estar vacio" });
    } else if (!exprecion.exec(rg_pass1)) {
        M.toast({
            html: "En el campo de contraseña, no se permiten carácteres especiales ni  espacios",
        });
    }
    if (rg_pass2 == "") {
        M.toast({ html: "El campo confirmar contraseña no puede estar vacio" });
    } else if (!exprecion.exec(rg_pass2)) {
        M.toast({
            html: "En el campo de contraseña, no se permiten carácteres especiales ni  espacios",
        });
    }

    if (rg_pass1 !== rg_pass2) {
        M.toast({ html: "Las contraseñas no coinciden " });
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
                //se manda un aviso de que realizo el regsitro con exito
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
        "user_name=" + rg_username + "& email=" + rg_email + "& password=" + rg_pass1
    );
}
