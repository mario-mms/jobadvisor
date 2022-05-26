$(function (){
    let peticion=$.ajax({
        "url":"https://public.opendatasoft.com/api/records/1.0/search/?dataset=provincias-espanolas&sort=provincia&rows=52",
        "method":"get",
        "dataType":"json"
    });
    peticion.done(function (data){
        $("#provincia").html("<option value='' selected>Selecciona la provincia</option>");
        for (let provincias of data.records){
            let provincia=provincias.fields.texto;
            $("#provincia").append(`<option value="${provincia}">${provincia}</option>`);
        }
    });
    $("#menu,#menu2").on("click",function (e){
        $("#desplegable").toggle(100);
    });
    $("main,footer").on("click",function (e){
        $("#desplegable").hide(100);
    })
    //Prohibir copiar, pegar y cortar
    $('body').bind('cut copy paste', function(event) {
        event.preventDefault();
    });

    $("input,textarea").on("keypress",function (e){
        if (e.charCode==60 || e.charCode==61 || e.charCode==62) return false;
    });
});