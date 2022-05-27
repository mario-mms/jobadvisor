$(function (){
    $("#candidatos").on("click",function (e){
        $("#accesos").fadeOut(1000);
        $("#iniciocandidatos").fadeIn(2000).css({
            "display":"flex"
        });
    });
    $("#empresas").on("click",function (e){
        $("#accesos").fadeOut(1000);
        $("#inicioempresas").fadeIn(2000).css({
            "display":"flex"
        });
    });
    $("#registrar").on("click",function (e){
        $("#iniciocandidatos").fadeOut(1000);
        $("#regcandidatos").fadeIn(2000);
    });
    $("#daralta").on("click",function (e){
        $("#inicioempresas").fadeOut(1000);
        $("#regempresas").fadeIn(2000);
    });

    $("#iniciosesion").on("click",function (e) {
        e.preventDefault();
        let email = $("#email").val();
        let pass = $("#pass").val();
        if (email=="" || pass==""){
            alert("Rellena los datos de inicio de sesión")
        }
        else{
            let peticion = $.ajax({
                "url": "iniciosesion.php",
                "method": "post",
                "data": {
                    "email": email,
                    "pass": pass
                }
            });
            peticion.done(function (data){
                let respuesta=data.correcto;
                if (respuesta=="candidato"){
                    location="ofertas.php";
                }
                else{
                    $("#aviso").text("Credenciales incorrectas");
                }
            }) ;
        }
    });
    $("#iniciosesion2").on("click",function (e) {
        e.preventDefault();
        let email2 = $("#email2").val();
        let pass2 = $("#pass2").val();
        if (email2=="" || pass2==""){
            alert("Rellena los datos de inicio de sesión")
        }
        else{

            let peticion = $.ajax({
                "url": "iniciosesion.php",
                "method": "post",
                "data": {
                    "email2": email2,
                    "pass2": pass2
                }
            });
            peticion.done(function (data){
                let respuesta=data.correcto;
                if (respuesta=="empresa"){
                    location="candidatos.php";
                }
                else{
                    $("#aviso2").text("Credenciales incorrectas");
                }
            })
        }
    });
    $("input,textarea").on("focus",function (e){
        $("#aviso,#aviso2,#aviso3,#aviso4").text("");
    });

    $("#registrocandidatos").on("click",function (e) {
        e.preventDefault();
        let email3 = $("#email3").val();
        let pass3 = $("#pass3").val();
        let nombrecand = $("#nombrecand").val();
        let apellido1 = $("#apellido1").val();
        let apellido2 = $("#apellido2").val();
        let nif = $("#nif").val();
        let telefonocand = $("#telefonocand").val();

        if (!nif.match(/^([0-9]{8}[A-Z])|[XYZ][0-9]{7}[A-Z]$/)) {
            $("#aviso3").text("Introduce un NIF/NIE correcto");
        }
        else if (!telefonocand.match(/^[0-9]{9}$/)) {
            $("#aviso3").text("Introduce un teléfono correcto");
        }
        else if (!email3.match(/^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)){
            $("#aviso3").text("Introduce un correo correcto");
        }
        else if (!pass3.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&-_])([A-Za-z\d$@$!%*?&-_]|[^ ]){8,15}$/)){
            $("#aviso3").text("La contraseña debe tener al menos una letra mayúscula, una minúscula, un número, un caracter especial y 8 de longitud mínima");
        }
        else if (email3=="" || pass3=="" || nombrecand=="" || apellido1=="" || apellido2=="" || nif=="" || telefonocand==""){
            $("#aviso3").text("Rellena todos los campos del formulario");
        }
        else{
            let peticion = $.ajax({
                "url": "registrocandidatos.php",
                "method": "post",
                "data": {
                    "nombre": nombrecand,
                    "email": email3,
                    "pass": pass3,
                    "apellido1": apellido1,
                    "apellido2": apellido2,
                    "nif": nif,
                    "telefono": telefonocand
                }
            });
            peticion.done(function (data){
                let respuesta=data.existe;
                if (respuesta=="si"){
                    $("#aviso3").text("El correo ya está registrado");
                }
                else if(respuesta=="nif"){
                    $("#aviso3").text("El NIF/NIE ya está registrado");
                }
                else{
                    location="cv.php";
                }
            })
        }
    });

    $("#registroempresas").on("click",function (e) {
        e.preventDefault();
        let email4 = $("#email4").val();
        let pass4 = $("#pass4").val();
        let nombreemp = $("#nombreemp").val();
        let informacion = $("#informacion").val();
        let cif = $("#cif").val();
        let telefonoemp = $("#telefonoemp").val();

        if (!cif.match(/^[a-zA-Z]{1}\d{7}[a-zA-Z0-9]{1}$/)) {
            $("#aviso4").text("Introduce un CIF correcto");
        }
        else if (!telefonoemp.match(/^[0-9]{9}$/)) {
            $("#aviso4").text("Introduce un teléfono correcto");
        }
        else if (!email4.match(/^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)){
            $("#aviso4").text("Introduce un correo correcto");
        }
        else if (!pass4.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&-_])([A-Za-z\d$@$!%*?&-_]|[^ ]){8,15}$/)){
            $("#aviso4").text("La contraseña debe tener al menos una letra mayúscula, una minúscula, un número, un caracter especial y 8 de longitud mínima");
        }
        else if (email4=="" || pass4=="" || nombreemp=="" || cif=="" || telefonoemp==""){
            $("#aviso4").text("Rellena todos los campos del formulario");
        }
        else{
            let peticion = $.ajax({
                "url": "registroempresas.php",
                "method": "post",
                "data": {
                    "nombre": nombreemp,
                    "email": email4,
                    "pass": pass4,
                    "informacion": informacion,
                    "cif": cif,
                    "telefono": telefonoemp
                }
            });
            peticion.done(function (data){
                let respuesta=data.existe;
                if (respuesta=="si"){
                    $("#aviso4").text("El correo ya está dado de alta");
                }
                else if (respuesta=="cif"){
                    $("#aviso4").text("El CIF ya está dado de alta");
                }
                else{
                    location="candidatos.php";
                }
            });
        }
    });



});
