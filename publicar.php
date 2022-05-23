<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['cif'])){
        $id_oferta=$_GET['id_oferta'];

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta=$mysql->query("SELECT * FROM ofertas WHERE id_oferta='$id_oferta'");
        $resultado=$consulta->fetch_assoc();

        $titulo=$resultado["titulo"];
        $horario=$resultado["horario"];
        $duracion=$resultado["duracion"];
        $salario=$resultado["salario"];
        $descripcion=$resultado["descripcion"];
    }
    else{
        header("Location:index.php");
    }
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Publicar oferta</title>
    <link rel="stylesheet" href="css/comun.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <a href="index.php"><img src="img/logopeq.png" alt="logo"></a>
        <div id="enlaces">
            <a href="candidatos.php">Buscar Candidatos</a>
            <a href="misofertas.php">Mis ofertas</a>
            <a href="publicar.php">Publicar oferta</a>
            <a href="opiniones.php">Opiniones</a>
            <a href="perfil.php">Perfil</a>
            <a href="cerrarsesion.php">Cerrar sesión</a>
        </div>
    </header>
    <main>
        <section id="publicar">
            <form action="publicaroferta.php" method="post">
                <label for="titulo">Puesto que buscas</label><br>
                <input type="text" name="titulo" id="titulo" required value="<?=$titulo?>"><br>
                <label for="horario">Horario</label><br>
                <input type="text" name="horario" id="horario" value="<?=$horario?>"><br>
                <label for="salario">Salario</label><br>
                <input type="text" name="salario" id="salario" value="<?=$salario?>"><br>
                <label for="duracion">Duración del contrato</label><br>
                <input type="text" name="duracion" id="duracion" value="<?=$duracion?>"><br>
                <label for="descripcion">Descripción del puesto</label><br>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?=$descripcion?></textarea><br>
                <label for="provincia">Provincia</label><br>
                <select name="provincia" id="provincia" required>
                    <option value="">Cargando...</option>
                </select><br>
                <input type="hidden" name="id_oferta" value="<?=$id_oferta?>">
                <button type="submit">Publicar oferta</button>
            </form>
        </section>
    </main>
    <footer>
        <h2>¿Tiene dudas o problemas?</h2>
        <a href="mailto:mario-mms@hotmail.com">mario-mms@hotmail.com</a>
    </footer>
</body>
</html>
<script src="js/jQuery.js"></script>
<script>
    $(function (){
        let peticion=$.ajax({
            "url":"https://public.opendatasoft.com/api/records/1.0/search/?dataset=provincias-espanolas&sort=provincia&rows=52",
            "method":"get",
            "dataType":"json"
        });
        peticion.done(function (data){
            $("#provincia").html("<option value='all' selected>Selecciona la provincia</option>");
            for (let provincias of data.records){
                let provincia=provincias.fields.texto;
                $("#provincia").append(`<option value="${provincia}">${provincia}</option>`);
            }
        });
    });
</script>