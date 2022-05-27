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
        $descripcion=filter_var($resultado['descripcion'],FILTER_SANITIZE_STRING);
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
        <a href="index.php"><img id="logo" src="img/logopeq.png" alt="logo"></a>
        <div id="enlaces">
            <a href="candidatos.php">Buscar Candidatos</a>
            <a href="publicar.php">Publicar oferta</a>
            <a href="opiniones.php">Opiniones</a>
        </div>
        <img id="menu" src="img/person.svg" alt="menu">
        <img id="menu2" src="img/menu.svg" alt="menu2">
        <div id="desplegable">
            <ul>
                <div id="oculto">
                    <li><a href="candidatos.php">Buscar Candidatos</a></li>
                    <li><a href="publicar.php">Publicar oferta</a></li>
                    <li><a href="opiniones.php">Opiniones</a></li>
                </div>
                <li><a href="misofertas.php">Mis ofertas</a></li>
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </header>
    <main>
        <h1>Publica tus ofertas</h1>
        <section id="publicar">
            <form action="publicaroferta.php" method="post">
                <label for="titulo">Puesto que buscas*</label><br>
                <input type="text" name="titulo" id="titulo" required value="<?=$titulo?>" pattern='[^<>"]+' title="No caracteres especiales"><br>
                <label for="horario">Horario</label><br>
                <input type="text" name="horario" id="horario" value="<?=$horario?>" pattern='[^<>"]+' title="No caracteres especiales"><br>
                <label for="salario">Salario</label><br>
                <input type="text" name="salario" id="salario" value="<?=$salario?>" pattern='[^<>"]+' title="No caracteres especiales"><br>
                <label for="duracion">Duración del contrato</label><br>
                <input type="text" name="duracion" id="duracion" value="<?=$duracion?>" pattern='[^<>"]+' title="No caracteres especiales"><br>
                <label for="descripcion">Descripción del puesto</label><br>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?=$descripcion?></textarea><br>
                <label for="provincia">Provincia*</label><br>
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
<script src="js/comun.js"></script>