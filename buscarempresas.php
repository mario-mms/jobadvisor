<?php
    session_start();
    if (isset($_SESSION["email"]) && isset($_SESSION["pass"]) && isset($_SESSION["nif"])){
        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        if (isset($_POST['nombre'])){
            $nombre=$_POST['nombre'];
            $consulta=$mysql->query("SELECT * FROM empresas WHERE nombre LIKE ('%$nombre%')");
            $resultado=$consulta->fetch_assoc();
        }
        else{
            $consulta=$mysql->query("SELECT * FROM empresas");
            $resultado=$consulta->fetch_assoc();
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
    <title>Buscador de Empresas</title>
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
        <section id="buscador">
            <form action="buscarempresas.php" method="post">
                <label for="empresa">Empresa</label>
                <input type="text" name="nombre">
                <button type="submit">Buscar</button>
            </form>
        </section>
        <section id="empresas">
            <?php
                while ($resultado){
                    echo "<div>";
                    echo "<h2>$resultado[nombre]</h2>";
                    echo "<p>$resultado[informacion]</p>";
                    echo "<h3>Contacto:</h3>";
                    echo "<p>Email: <a href='mailto:$resultado[email]'>$resultado[email]</a></p>";
                    echo "<p>Email: <a href='tel:$resultado[telefono]'>$resultado[telefono]</a></p>";
                    echo "<p><a href='opinar.php?id_empresa=$resultado[id_empresa]'>Opinar</a></p>";
                    echo "</div>";

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