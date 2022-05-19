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
        $informacion=$resultado["informacion"];
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
</head>
<body>
    <header>
        <a href="index.php"><img src="img/logopeq.png" alt="logo"></a>
        <?php
            if ($cif!==NULL){
                echo '<div id="enlaces">
                            <a href="candidatos.php">Buscar Candidatos</a>
                            <a href="misofertas.php">Mis ofertas</a>
                            <a href="publicar.php">Publicar oferta</a>
                            <a href="opiniones.php">Opiniones</a>
                            <a href="perfil.php">Perfil</a>
                            <a href="cerrarsesion.php">Cerrar sesión</a>
                        </div>';
            }
            else if ($nif!==NULL){
                echo '<div id="enlaces">
                            <a href="ofertas.php">Buscar Ofertas</a>
                            <a href="misopiniones.php">Mis opiniones</a>
                            <a href="buscarempresas.php">Buscar empresas</a>
                            <a href="cv.php">MI CV</a>
                            <a href="perfil.php">Perfil</a>
                            <a href="cerrarsesion.php">Cerrar sesión</a>
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
                    <input type='text' name='nombre' value='$nombre' required><br>
                    <label for='CIF'>CIF</label><br>
                    <input type='text' name='CIF' value='$cif' required pattern='^([ABCDFGHJKLMNPQRSUVWabcdfghlmnpqrsuvw])([0-9]{7})([0-9A-Ja]$' maxlength='9'><br>
                    <label for='telefono'>Teléfono de contacto</label><br>
                    <input type='tel' name='telefono' value='$telefono' required maxlength='9'><br>
                    <label for='informacion'>Información adicional</label><br>
                    <textarea name='informacion' style='width: 100%; border-radius: 5px;' rows='4'>$informacion</textarea><br>
                    <label for='email'>Correo electrónico</label><br>
                    <input type='email' name='email' value='$email' required><br>
                    <label for='pass'>Contraseña</label><br>
                    <input type='password' name='pass' required><br>
                    <input type='hidden' name='id_empresa' value='$id_empresa'>
                    <button type='submit'>Modificar datos</button>
                </form>";
                }
                else if ($nif!==NULL){
                    echo "<h2>Modifica tus datos</h2>
                <h3>Los siguientes campos son obligatorios</h3>
                    <form action='registrocandidatos.php' method='post'>
                    <label for='nombre'>Nombre:</label><br>
                    <input type='text' name='nombre' value='$nombre' required><br>
                    <label for='apellido1'>Primer apellido:</label><br>
                    <input type='text' name='apellido1' value='$apellido1' required><br>
                    <label for='apellido2'>Segundo apellido:</label><br>
                    <input type='text' name='apellido2' value='$apellido2' required><br>
                    <label for='NIF'>NIF</label><br>
                    <input type='text' name='nif' value='$nif' pattern='(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))' maxlength='9' required disabled><br>
                    <label for='telefono'>Teléfono de contacto</label><br>
                    <input type='tel' name='telefono' value='$telefono' required maxlength='9'><br>
                    <label for='email'>Correo electrónico</label><br>
                    <input type='email' name='email' value='$email' required><br>
                    <label for='pass'>Contraseña</label><br>
                    <input type='password' name='pass' required><br>
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