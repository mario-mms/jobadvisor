<?php
    session_start();
    if (isset($_SESSION["email"]) && isset($_SESSION["pass"]) && isset($_SESSION["nif"])){
        if (isset($_GET['id_empresa'])){
            $id_empresa=$_GET['id_empresa'];
        }
        else{
            $id_empresa=$_POST['id_empresa'];
        }
        $nif=$_SESSION['nif'];

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta0=$mysql->query("SELECT id_candidato FROM candidatos WHERE nif='$nif'");
        $resultado0=$consulta0->fetch_assoc();
        $id_candidato=$resultado0['id_candidato'];

        $consulta00=$mysql->query("SELECT * FROM empresas WHERE id_empresa='$id_empresa'");
        $resultado00=$consulta00->fetch_assoc();
        $nombre=$resultado00["nombre"];

        $consulta=$mysql->query("SELECT * FROM opiniones LEFT JOIN respuestas USING (id_opinion) WHERE id_empresa='$id_empresa'");
        $resultado=$consulta->fetch_assoc();

        if (isset($_POST['opinion'])){
            $opinion=filter_var(nl2br($_POST['opinion']),FILTER_SANITIZE_STRING);
            $puesto=filter_var($_POST['puesto'],FILTER_SANITIZE_STRING);
            $inicio_contrato=$_POST['inicio_contrato'];
            $fin_contrato=$_POST['fin_contrato'];

            $consulta1=$mysql->query("INSERT INTO opiniones (id_empresa,id_candidato,opinion,fecha_actual,puesto,inicio_contrato,fin_contrato)
                                    VALUES ('$id_empresa','$id_candidato','$opinion',current_date ,'$puesto','$inicio_contrato','$fin_contrato')");

            header("Location:opinar.php?id_empresa=$id_empresa");
        }
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
    <title>Perfil Empresa</title>
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
        <section id="opinar">
            <?php
                echo "<h1>Empresa: $nombre</h1>";
            ?>
            <h3>Tú opinión puede ser útil para el resto de candidatos</h3>
            <form action="opinar.php" method="post">
                <label for="puesto">Puesto desempeñado</label><br>
                <input type="text" name="puesto" required><br>
                <label for="opinion">Opinión</label><br>
                <textarea name="opinion" rows="5" required></textarea><br>
                <label for="inicio">Inicio de Contrato</label><br>
                <input type="date" name="inicio_contrato"><br>
                <label for="fin">Fin de Contrato</label><br>
                <input type="date" name="fin_contrato"><br>
                <input type="hidden" name="id_empresa" value="<?=$id_empresa?>">
                <input type="hidden" name="id_candidato" value="<?=$id_candidato?>">
                <button type="submit">Opinar</button>
            </form>
        </section>
        <h1>Opiniones</h1>
        <section id="opiniones">
            <?php
            while ($resultado){
                echo "<div>";
                echo "<h3>Puesto desempeñado: $resultado[puesto]</h3>";
                echo "<h4>Opinión:</h4>";
                echo "<p>$resultado[opinion]</p>";
                echo "<p><strong>Inicio del contrato:</strong> $resultado[inicio_contrato]</p>";
                echo "<p><strong>Fin del contrato:</strong> $resultado[fin_contrato]</p>";

                if ($resultado['cabecera']!==NULL){
                    echo "<h2>Respuesta</h2>";
                    echo "<h3>$resultado[cabecera]</h3>";
                    echo "<p>$resultado[respuesta]</p>";
                    echo "</div>";
                }
                else{
                    echo "</div>";
                }

                $resultado=$consulta->fetch_assoc();
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