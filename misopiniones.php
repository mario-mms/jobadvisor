<?php
    session_start();
    if (isset($_SESSION["email"]) && isset($_SESSION["pass"]) && isset($_SESSION["nif"])){

        $nif=$_SESSION['nif'];
        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta=$mysql->query("SELECT id_opinion,e.nombre empresa,opinion,o.fecha_actual publicado,puesto,inicio_contrato,fin_contrato 
                                    FROM candidatos c JOIN opiniones o USING (id_candidato) JOIN empresas e USING (id_empresa) WHERE nif='$nif'");
        $resultado=$consulta->fetch_assoc();

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
    <title>Mis opiniones</title>
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
        <section id="opiniones">
            <?php
            if ($resultado==NULL){
                echo "<h3>No has publicado ninguna opinión</h3>";
            }
            else{
                while($resultado){
                    echo "<div>";
                    echo "<h2>$resultado[empresa]</h2>";
                    echo "<p>Fecha de publicación: $resultado[publicado]</p>";
                    echo "<p>Opinión:</p>";
                    echo "<p>$resultado[opinion]</p>";
                    echo "<p>Puesto: $resultado[puesto]</p>";
                    echo "<p>Inicio del contrato: $resultado[inicio_contrato]</p>";
                    echo "<p>Fin del contrato: $resultado[fin_contrato]</p>";
                    echo "<p><a href='borrar.php?id_opinion=$resultado[id_opinion]'>Borrar opinión</a></p>";

                    $consulta2=$mysql->query("SELECT * FROM respuestas JOIN opiniones USING (id_opinion) WHERE id_opinion='$resultado[id_opinion]'");
                    if ($mysql->affected_rows!==0){
                        $resultado2=$consulta2->fetch_assoc();
                        echo "<h1>Respuesta</h1>";
                        echo "<h3>$resultado2[cabecera]</h3>";
                        echo "<p>$resultado2[respuesta]</p>";
                        echo "</div>";
                    }
                    else{
                        echo "</div>";
                    }
                    $resultado=$consulta->fetch_assoc();
                }
            }
            ?>
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