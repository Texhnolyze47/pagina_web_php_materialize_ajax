/**
 *  validacion formulario de registro
 * */
function register() {
    var rg_username = document.querySelector("#rg_username").value;
    var rg_email = document.querySelector("#rg_email").value;
    var rg_pass1 = document.querySelector("#rg_pass1").value;
    var rg_pass2 = document.querySelector("#rg_pass2").value;

    email_exprecion = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    exprecion = /^[0-9a-zA-Z0-9]+$/;

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
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var response = ajax.responseText;
        }
    };
    ajax.open(method, URL, true);
    ajax.setRequestHeader("Contend-type", "application");
}
