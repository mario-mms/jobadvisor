<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['cif'])){

        $cif=$_SESSION['cif'];

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta=$mysql->query("SELECT * FROM ofertas JOIN empresas USING (id_empresa) WHERE cif='$cif'");
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
    <title>Mis ofertas</title>
    <link rel="stylesheet" href="css/comun.css">
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
        <section id="misofertas">
            <?php
                if ($resultado==NULL){
                    echo "<h3>No has publicado ninguna oferta</h3>";
                }
                else{
                    while ($resultado){

                        echo "<div>";
                        echo "<h2>$resultado[titulo]</h2>";
                        echo "<p>Salario: $resultado[salario] €</p>";
                        echo "<p>Duración: $resultado[duracion]</p>";
                        echo "<p>Horario: $resultado[horario]</p>";
                        echo "<p>Fecha de publicación: $resultado[fecha_actual]</p>";
                        echo "<p>Provincia: $resultado[provincia]</p>";
                        echo "<p>Descripción: $resultado[descripcion]</p>";
                        echo "<a href='publicar.php?id_oferta=$resultado[id_oferta]'>Editar</a><br>";
                        echo "<a href='borrar.php?id_oferta=$resultado[id_oferta]'>Borrar oferta</a>";
                        echo "</div>";

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