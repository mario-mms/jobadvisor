<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['cif'])){

        $cif=$_SESSION['cif'];
        $nif=NULL;

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta=$mysql->query("SELECT * FROM empresas WHERE cif='$cif'");
        $resultado=$consulta->fetch_assoc();

        $nombre=$resultado["nombre"];
        $cif=$resultado["cif"];
        $telefono=$resultado["telefono"];
        $informacion=filter_var($resultado['informacion'],FILTER_SANITIZE_STRING);;
        $email=$resultado["email"];
        $pass=$resultado["password"];
        $id_empresa=$resultado["id_empresa"];
    }
    else if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['nif'])){
        $cif=NULL;
        $nif=$_SESSION['nif'];

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta=$mysql->query("SELECT * FROM candidatos WHERE nif='$nif'");
        $resultado=$consulta->fetch_assoc();

        $nombre=$resultado["nombre"];
        $apellido1=$resultado["apellido1"];
        $apellido2=$resultado["apellido2"];
        $nif=$resultado["nif"];
        $telefono=$resultado["telefono"];
        $email=$resultado["email"];
        $pass=$resultado["password"];
        $id_candidato=$resultado["id_candidato"];
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
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="css/comun.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <?php
            if ($cif!==NULL){
                echo '<a href="index.php"><img id="logo" src="img/logopeq.png" alt="logo"></a>
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
        </div>';
            }
            else if ($nif!==NULL){
                echo '<a href="index.php"><img id="logo" src="img/logopeq.png" alt="logo"></a>
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
        </div>';
            }
        ?>
    </header>
    <main>
        <section id="datos">
            <?php
                if ($cif!==NULL){
                    echo "<h2>Modifica tus datos</h2>
                <h3>Los siguientes campos son obligatorios</h3>
                <form action='registroempresas.php' method='post'>
                    <label for='nombre'>Nombre de la empresa</label><br>
                    <input type='text' name='nombre' value='$nombre' required ><br>
                    <label for='cif'>CIF</label><br>
                    <input type='text' name='cif' value='$cif' required pattern='^[a-zA-Z]{1}\d{7}[a-zA-Z0-9]{1}$' maxlength='9' disabled><br>
                    <label for='telefono'>Teléfono de contacto</label><br>
                    <input type='tel' name='telefono' value='$telefono' required maxlength='9' pattern='^[0-9]{9}$'><br>
                    <label for='informacion'>Información adicional</label><br>
                    <textarea name='informacion' rows='5'>$informacion</textarea><br>
                    <label for='email'>Correo electrónico</label><br>
                    <input type='email' name='email' value='$email' required disabled><br>
                    <label for='pass'>Contraseña</label><br>
                    <input type='password' name='pass' required 
                    pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&-_])([A-Za-z\d$@$!%*?&-_]|[^ ]){8,15}$'
                    title='La contraseña debe tener al menos una letra mayúscula, una minúscula, un número, un caracter especial y 8 de longitud mínima'><br>
                    <input type='hidden' name='id_empresa' value='$id_empresa'>
                    <button type='submit'>Modificar datos</button>
                </form>";
                }
                else if ($nif!==NULL){
                    echo "<h2>Modifica tus datos</h2>
                <h3>Los siguientes campos son obligatorios</h3>
                    <form action='registrocandidatos.php' method='post'>
                    <label for='nombre'>Nombre:</label><br>
                    <input type='text' name='nombre' value='$nombre' required pattern='[A-Za-z]+' title='Sólo letras'><br>
                    <label for='apellido1'>Primer apellido:</label><br>
                    <input type='text' name='apellido1' value='$apellido1' required pattern='[A-Za-z]+' title='Sólo letras'><br>
                    <label for='apellido2'>Segundo apellido:</label><br>
                    <input type='text' name='apellido2' value='$apellido2' required pattern='[A-Za-z]+' title='Sólo letras'><br>
                    <label for='NIF'>NIF/NIE</label><br>
                    <input type='text' name='nif' value='$nif' pattern='^([0-9]{8}[A-Z])|[XYZ][0-9]{7}[A-Z]$' maxlength='9' required disabled><br>
                    <label for='telefono'>Teléfono de contacto</label><br>
                    <input type='tel' name='telefono' value='$telefono' required maxlength='9' pattern='^[0-9]{9}$'><br>
                    <label for='email'>Correo electrónico</label><br>
                    <input type='email' name='email' value='$email' required disabled><br>
                    <label for='pass'>Contraseña</label><br>
                    <input type='password' name='pass' required 
                    pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&-_])([A-Za-z\d$@$!%*?&-_]|[^ ]){8,15}$'
                    title='La contraseña debe tener al menos una letra mayúscula, una minúscula, un número, un caracter especial y 8 de longitud mínima'><br>
                    <input type='hidden' name='id_candidato' value='$id_candidato'>
                    <button type='submit'>Modificar datos</button>
                </form>";
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