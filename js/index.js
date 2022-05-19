$(function (){
    $("#candidatos").on("click",function (e){
        $("#accesos").fadeOut(1000);
        $("#registrocandidatos").fadeIn(2000).css({
            "display":"flex"
        });
    });
    $("#empresas").on("click",function (e){
        $("#accesos").fadeOut(1000);
        $("#registroempresas").fadeIn(2000).css({
            "display":"flex"
        });
    });
    $("#registrar").on("click",function (e){
        $("#registrocandidatos").fadeOut(1000);
        $("#regcandidatos").fadeIn(2000);
    });
    $("#daralta").on("click",function (e){
        $("#registroempresas").fadeOut(1000);
        $("#regempresas").fadeIn(2000);
    });


    $("#iniciosesion").on("click",function (e) {
        //e.preventDefault();
        let email = $("#email").val();
        let pass = $("#pass").val();
        console.log(email);
        console.log(pass);
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
            console.log(respuesta);
            if (respuesta=="si"){
                location="ofertas.php";
            }
            else{
                $("#aviso").text("Credenciales incorrectas");
            }
        })
    });
    $("#iniciosesion2").on("click",function (e) {
        //e.preventDefault();
        let email2 = $("#email2").val();
        let pass2 = $("#pass2").val();
        console.log(email2);
        console.log(pass2);
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
            console.log(respuesta);
            if (respuesta=="si"){
                location="misofertas.php";
            }
            else{
                $("#aviso2").text("Credenciales incorrectas");
            }
        })
    });
    $("#email,#email2,#pass,#pass2").on("click",function (e){
        $("#aviso,#aviso2").text("");
    });

});