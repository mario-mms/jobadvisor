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

        $consulta2=$mysql->query("SELECT id_cv,fecha_actual, experiencia,titulacion,masinfo FROM cv c JOIN experiencia e USING (id_cv) 
                                            JOIN titulacion t USING (id_cv) JOIN masinfo m USING (id_cv) WHERE id_candidato='$id_candidato'");
        $resultado2=$consulta2->fetch_assoc();

        $id_cv=$resultado2['id_cv'];
        $fecha_actual=$resultado2['fecha_actual'];
        $experiencia=filter_var($resultado2['experiencia'],FILTER_SANITIZE_STRING);
        $titulacion=filter_var($resultado2['titulacion'],FILTER_SANITIZE_STRING);
        $masinfo=filter_var($resultado2['masinfo'],FILTER_SANITIZE_STRING);

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
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <a href="index.php"><img id="logo" src="img/logopeq.png" alt="logo"></a>
        <div id="enlaces">
            <a href="ofertas.php">Buscar Ofertas</a>
            <a href="buscarempresas.php">Buscar empresas</a>
            <a href="ofertasexternas.php">Ofertas externas</a>
        </div>
        <img id="menu" src="img/person.svg" alt="menu">
        <img id="menu2" src="img/menu.svg" alt="menu2">
        <div id="desplegable">
            <ul>
                <div id="oculto">
                    <li><a href="ofertas.php">Buscar Ofertas</a></li>
                    <li><a href="buscarempresas.php">Buscar empresas</a></li>
                    <li><a href="ofertasexternas.php">Ofertas externas</a></li>
                </div>
                <li><a href="misopiniones.php">Mis opiniones</a></li>
                <li><a href="cv.php">MI CV</a></li>
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
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
                <textarea name="titulacion" id="titulacion" rows="6"><?=$titulacion?></textarea><br>
                <label for="experiencia">Experiencia laboral</label><br>
                <textarea name="experiencia" id="experiencia" rows="6"><?=$experiencia?></textarea><br>
                <label for="mas">Más información</label><br>
                <textarea name="mas" id="mas" rows="6"><?=$masinfo?></textarea><br>
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
<script src="js/comun.js"></script>