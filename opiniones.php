<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['cif'])){

        $cif=$_SESSION['cif'];

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta=$mysql->query("SELECT * FROM empresas JOIN opiniones USING (id_empresa) WHERE cif='$cif'");
        $resultado=$consulta->fetch_assoc();

        if (isset($_POST['cabecera']) && isset($_POST['respuesta']) && isset($_POST['id_opinion'])){
            $cabecera=$_POST['cabecera'];
            $respuesta=$_POST['respuesta'];
            $id_opinion=$_POST['id_opinion'];
            $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
            $consulta3=$mysql->query("INSERT INTO respuestas (id_opinion,cabecera,respuesta) 
                                            VALUES ('$id_opinion','$cabecera','$respuesta')");
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
    <title>Opiniones</title>
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
        <section id="opiniones">
            <?php
            if ($resultado==NULL){
                echo "<h3>No hay ninguna opinión</h3>";
            }
            else{
                while($resultado){
                    echo "<div>";
                    echo "<p>Puesto: $resultado[puesto]</p>";
                    echo "<p>Fecha de publicación: $resultado[fecha_actual]</p>";
                    echo "<p>Opinión:</p>";
                    echo "<p>$resultado[opinion]</p>";
                    echo "<p>Inicio del contrato: $resultado[inicio_contrato]</p>";
                    echo "<p>Fin del contrato: $resultado[fin_contrato]</p>";

                    $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
                    $consulta2=$mysql->query("SELECT * FROM respuestas JOIN opiniones USING (id_opinion) WHERE id_opinion='$resultado[id_opinion]'");
                    if ($mysql->affected_rows==0){
                        echo "<form action='opiniones.php' method='post'>";
                        echo "<label for='cabecera'>Cabecera:</label><br>";
                        echo "<input type='text' name='cabecera'><br>";
                        echo "<label for='respuesta'>Respuesta:</label><br>";
                        echo "<textarea name='respuesta' cols='30' rows='15'></textarea><br>";
                        echo "<input type='hidden' name='id_opinion' value='$resultado[id_opinion]'> ";
                        echo "<button type='submit'>Responder</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                    else{
                        $resultado2=$consulta2->fetch_assoc();
                        echo "<h1>Respuesta</h1>";
                        echo "<h3>$resultado2[cabecera]</h3>";
                        echo "<p>$resultado2[respuesta]</p>";
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