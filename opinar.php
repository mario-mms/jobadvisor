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

            $opinion=$_POST['opinion'];
            $puesto=$_POST['puesto'];
            $inicio_contrato=$_POST['inicio_contrato'];
            $fin_contrato=$_POST['fin_contrato'];

            $consulta1=$mysql->query("INSERT INTO opiniones (id_empresa,id_candidato,opinion,fecha_actual,puesto,inicio_contrato,fin_contrato)
                                    VALUES ('$id_empresa','$id_candidato','$opinion',current_date ,'$puesto','$inicio_contrato','$fin_contrato')");
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
</head>
<body>
    <header>
        <a href="index.php"><img src="img/logopeq.png" alt="logo"></a>
        <div id="enlaces">
            <a href="ofertas.php">Buscar Ofertas</a>
            <a href="misopiniones.php">Mis opiniones</a>
            <a href="buscarempresas.php">Buscar empresas</a>
            <a href="cv.php">MI CV</a>
            <a href="perfil.php">Perfil</a>
            <a href="cerrarsesion.php">Cerrar sesión</a>
        </div>
    </header>
    <main>
        <section id="empresa">
            <?php
                echo "<h2>$nombre</h2>";
            ?>
        </section>
        <section id="opinar">
            <h1>Tú opinion puede ser útil para el resto de candidatos</h1>
            <form action="opinar.php" method="post">
                <label for="opinion">Opinión</label><br>
                <textarea name="opinion" cols="30" rows="10" required></textarea><br>
                <label for="puesto">Puesto desempeñado</label><br>
                <input type="text" name="puesto" required><br>
                <label for="inicio">Inicio de Contrato</label><br>
                <input type="date" name="inicio_contrato"><br>
                <label for="fin">Fin de Contrato</label><br>
                <input type="date" name="fin_contrato"><br>
                <input type="hidden" name="id_empresa" value="<?=$id_empresa?>">
                <input type="hidden" name="id_candidato" value="<?=$id_candidato?>">
                <button type="submit">Opinar</button>
            </form>
        </section>
        <section id="opiniones">
            <?php
            while ($resultado){
                echo "<div>";
                echo "<h3>Puesto desempeñado: $resultado[puesto]</h3>";
                echo "<p>Opinión: $resultado[opinion]</p>";
                echo "<p>Inicio del contrato: $resultado[inicio_contrato]</p>";
                echo "<p>Fin del contrato: $resultado[fin_contrato]</p>";

                if ($resultado['cabecera']!==NULL){
                    echo "<h1>Respuesta</h1>";
                    echo "<h3>$resultado[cabecera]</h3>";
                    echo "<p>$resultado[respuesta]</p>";
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