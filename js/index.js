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
    $("#email,#email2,#pass,#pass2,#email3,#email4").on("mousedown",function (e){
        $("#aviso,#aviso2,#aviso3,#aviso4").text("");
    });
    //EVITAR INYECCIÓN
    $("#registrocandidatos").on("click",function(e){
        e.preventDefault();
        let telefono=$("#telefonocand").val();
        let email=$("#email3").val();
        let nif=$("#nif").val();
        let pass=$("#pass").val();
        if (telefono.match(/^[0-9]{9}$/)) {
            alert("Bien");
        }
        else {alert("ZURULLOOO");}
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

        if (email3=="" || pass3=="" || nombrecand=="" || apellido1=="" || apellido2=="" || nif=="" || telefonocand==""){
            alert("Rellena todos los campos del formulario")
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

        if (email4=="" || pass4=="" || nombreemp=="" || informacion=="" || cif=="" || telefonoemp==""){
            alert("Rellena todos los campos del formulario")
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
                else{
                    location="candidatos.php";
                }
            });
        }
    });



});
