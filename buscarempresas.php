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
        <h1 id="eslogan">Encuentra la empresa</h1>
        <section id="buscador">
            <form action="buscarempresas.php" method="post">
                <label for="empresa">Empresa</label>
                <input type="search" name="nombre">
                <button type="submit">Buscar</button>
            </form>
        </section>
        <section id="empresas">
            <?php
                while ($resultado){
                    echo "<div>";
                    echo "<h2><a href='opinar.php?id_empresa=$resultado[id_empresa]'>$resultado[nombre]</a></h2>";
                    echo "<p>$resultado[informacion]</p>";
                    echo "<h3>Contacto:</h3>";
                    echo "<p>Email: <a href='mailto:$resultado[email]'>$resultado[email]</a></p>";
                    echo "<p>Teléfono: <a href='tel:$resultado[telefono]'>$resultado[telefono]</a></p>";
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