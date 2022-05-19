<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['nif'])){
        $email=$_SESSION['email'];
        $pass=$_SESSION['pass'];
        $nif=$_SESSION['nif'];

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta=$mysql->query("SELECT id_candidato FROM candidatos where nif='$nif'");
        $resultado=$consulta->fetch_assoc();
        $id_candidato=$resultado["id_candidato"];

        $consulta2=$mysql->query("SELECT id_cv,fecha_actual,experiencia,titulacion,masinfo FROM cv c JOIN experiencia e USING (id_cv) 
                                            JOIN titulacion t USING (id_cv) JOIN masinfo m USING (id_cv) WHERE id_candidato='$id_candidato'");
        $resultado2=$consulta2->fetch_assoc();

        $id_cv=$resultado2['id_cv'];
        $fecha_actual=$resultado2['fecha_actual'];
        $experiencia=$resultado2['experiencia'];
        $titulacion=$resultado2['titulacion'];
        $masinfo=$resultado2['masinfo'];

        $consulta->close();
        $consulta2->close();
        $mysql->close();
    }
    else{
        header("Location:index.php");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añade tu CV</title>
    <link rel="stylesheet" href="css/comun.css">
</head>
<body>
    <header>
        <a href="index.php"><img src="img/logopeq.png" alt="logo"></a>
        <div id="enlaces">
            <a href="ofertas.php">Buscar Ofertas</a>
            <a href="buscarempresas.php">Mis opiniones</a>
            <a href="publicar.php">Publicar opinión</a>
            <a href="cv.php">MI CV</a>
            <a href="perfil.php">Perfil</a>
            <a href="cerrarsesion.php">Cerrar sesión</a>
        </div>
    </header>
    <main>
        <section id="cv">
            <form action="curriculum.php" method="post">
                <?php if (isset($fecha_actual)){
                    echo "<h3>Última actualización: $fecha_actual</h3>";
                }?>
                <label for="provincia">Provincia</label><br>
                <select name="provincia" id="provincia" required>
                    <option value="">Cargando...</option>
                </select><br>
                <label for="titulación">Titulación</label><br>
                <textarea name="titulacion" id="titulacion" cols="30" rows="10"><?=$titulacion?></textarea><br>
                <label for="experiencia">Experiencia laboral</label><br>
                <textarea name="experiencia" id="experiencia" cols="30" rows="10"><?=$experiencia?></textarea><br>
                <label for="mas">Más información</label><br>
                <textarea name="mas" id="mas" cols="30" rows="10"><?=$masinfo?></textarea><br>
                <input type="hidden" name="id_cv" value="<?=$id_cv?>">
                <input type="hidden" name="id_candidato" value="<?=$id_candidato?>">
                <button type="submit">Guardar datos</button>
                <a href="ofertas.php">Saltarse este paso</a>
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
            $("#provincia").html("<option value='' disabled selected>Selecciona la provincia</option>");
            for (let provincias of data.records){
                let provincia=provincias.fields.texto;
                $("#provincia").append(`<option value="${provincia}">${provincia}</option>`);
            }
        });
    });
</script>