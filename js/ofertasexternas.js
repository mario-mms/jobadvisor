$(function (){
    let i=0;
    let z=i+30;
    let peticion0=$.ajax({
        "url":`https://analisis.datosabiertos.jcyl.es/api/records/1.0/search/?dataset=ofertas-de-empleo&q=&rows=${z}&start=${i}&sort=fecha_de_publicacion&facet=provincia&facet=fecha_de_publicacion&facet=fuentecontenido`,
        "method":"get",
        "dataType":"json"
    });
    peticion0.done(function (data){
        let datos=data.nhits;
        let paginas=parseInt(datos/30);
        let a=0;
        do{
            $("#paginacion").append(`<p id="${a}">${a}</p>`);
            a++;
        }while(a<=paginas);
        for (let records of data.records){
            let fuente=records.fields.fuentecontenido;
            let fecha=records.fields.ultimaactualizacion;
            let titulo=records.fields.titulo;
            let provincia=records.fields.provincia;
            let localidad=records.fields.localidad;
            let enlace=records.fields.enlace_al_contenido;
            if (localidad==undefined){
                localidad="No especifica";
            }
            $("#ofertas").append(`<div>
                                            <h1>${titulo}</h1>
                                            <p>${localidad} (${provincia})</p>
                                            <p>Fuente: ${fuente}</p>
                                            <p>Fecha: ${fecha}</p>
                                            <p><a href="${enlace}" target="_blank">Enlace al contenido</a></p>
                                    </div>`);
        }
    });

    $("#cyl").on("change",function (e){
        $("#ofertas").html("");
        $("#paginacion").html("");
        let provincia=$("#cyl").val();
        let peticion0=$.ajax({
            "url":`https://analisis.datosabiertos.jcyl.es/api/records/1.0/search/?dataset=ofertas-de-empleo&q=&rows=${z}&start=${i}&sort=fecha_de_publicacion&facet=provincia&facet=fecha_de_publicacion&facet=fuentecontenido&refine.provincia=${provincia}`,
            "method":"get",
            "dataType":"json"
        });
        peticion0.done(function (data){
            let datos=data.nhits;
            let paginas=parseInt(datos/30);
            let a=0;
            do{
                $("#paginacion").append(`<p id="${a}">${a}</p>`);
                a++;
            }while(a<=paginas);
            for (let records of data.records){
                let fuente=records.fields.fuentecontenido;
                let fecha=records.fields.ultimaactualizacion;
                let titulo=records.fields.titulo;
                let provincia=records.fields.provincia;
                let localidad=records.fields.localidad;
                let enlace=records.fields.enlace_al_contenido;
                if (localidad==undefined){
                    localidad="No especifica";
                }
                $("#ofertas").append(`<div>
                                            <h1>${titulo}</h1>
                                            <p>${localidad} (${provincia})</p>
                                            <p>Fuente: ${fuente}</p>
                                            <p>Fecha: ${fecha}</p>
                                            <p><a href="${enlace}" target="_blank">Enlace al contenido</a></p>
                                    </div>`);
            }
        });
    });

    $("#paginacion").on("click","p",function (e){
        let id=$(e.currentTarget).attr("id");
        let i=30*id;
        $("#ofertas").html("");
        let peticion0=$.ajax({
            "url":`https://analisis.datosabiertos.jcyl.es/api/records/1.0/search/?dataset=ofertas-de-empleo&q=&rows=${z}&start=${i}&sort=fecha_de_publicacion&facet=provincia&facet=fecha_de_publicacion&facet=fuentecontenido`,
            "method":"get",
            "dataType":"json"
        });
        peticion0.done(function (data){
            for (let records of data.records){
                let fuente=records.fields.fuentecontenido;
                let fecha=records.fields.ultimaactualizacion;
                let titulo=records.fields.titulo;
                let provincia=records.fields.provincia;
                let localidad=records.fields.localidad;
                let enlace=records.fields.enlace_al_contenido;
                if (localidad==undefined){
                    localidad="No especifica";
                }
                $("#ofertas").append(`<div>
                                            <h1>${titulo}</h1>
                                            <p>${localidad} (${provincia})</p>
                                            <p>Fuente: ${fuente}</p>
                                            <p>Fecha: ${fecha}</p>
                                            <p><a href="${enlace}" target="_blank">Enlace al contenido</a></p>
                                    </div>`);
            }
        });
    });
});