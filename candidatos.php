<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['cif'])){
        if (isset($_POST['provincia']) && isset($_POST['experiencia'])){
            if ($_POST['provincia']=="" && $_POST['experiencia']!==''){
                $provincia=$_POST['provincia'];
                $experiencia=$_POST['experiencia'];
                $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
                $consulta=$mysql->query("SELECT * FROM candidatos JOIN cv USING (id_candidato) JOIN experiencia USING (id_cv)
                                    JOIN titulacion USING (id_cv) JOIN masinfo USING (id_cv) WHERE experiencia LIKE '%$experiencia%'");
                //AND MATCH(experiencia) AGAINST ('$experiencia')");
                $resultado=$consulta->fetch_assoc();
            }
            else if ($_POST['experiencia']=='' && $_POST['provincia']!==""){
                $provincia=$_POST['provincia'];
                $experiencia=$_POST['experiencia'];
                $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
                $consulta=$mysql->query("SELECT * FROM candidatos JOIN cv USING (id_candidato) JOIN experiencia USING (id_cv)
                                    JOIN titulacion USING (id_cv) JOIN masinfo USING (id_cv) WHERE provincia = '$provincia'");
                $resultado=$consulta->fetch_assoc();
            }
            else if($_POST['provincia']!=="" && $_POST['experiencia']!==""){
                $provincia=$_POST['provincia'];
                $experiencia=$_POST['experiencia'];
                $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
                $consulta=$mysql->query("SELECT * FROM candidatos JOIN cv USING (id_candidato) JOIN experiencia USING (id_cv)
                                    JOIN titulacion USING (id_cv) JOIN masinfo USING (id_cv) WHERE provincia = '$provincia' 
                                    AND experiencia like '%$experiencia%'");
                $resultado=$consulta->fetch_assoc();
            }
            else{
                $experiencia=NULL;
                $provincia=NULL;
                $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
                $consulta=$mysql->query("SELECT * FROM candidatos LEFT JOIN cv USING (id_candidato) LEFT JOIN experiencia USING (id_cv)
                                    LEFT JOIN titulacion USING (id_cv) LEFT JOIN masinfo USING (id_cv)");
                $resultado=$consulta->fetch_assoc();
            }
        }
        else{
                $experiencia=NULL;
                $provincia=NULL;
                $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
                $consulta=$mysql->query("SELECT * FROM candidatos LEFT JOIN cv USING (id_candidato) LEFT JOIN experiencia USING (id_cv)
                                    LEFT JOIN titulacion USING (id_cv) LEFT JOIN masinfo USING (id_cv)");
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
    <title>Buscar Candidatos</title>
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
        <h1>Encuentra el candidato adecuado</h1>
        <section id="buscador">
            <form action="candidatos.php" method="post">
                <label for="oferta">¿Qué experiencia debe tener?</label>
                <input type="search" name="experiencia" value="<?=$experiencia?>">
                <label for="provincia">Provincia</label>
                <select name="provincia" id="provincia">
                    <option value="">Cargando...</option>
                </select>
                <button type="submit">Buscar</button>
            </form>
        </section>
        <section id="candidatos">
            <?php
                while ($resultado){
                    echo "<div>";
                    echo "<h2>$resultado[nombre] $resultado[apellido1] $resultado[apellido2]</h2>";
                    echo "<h3>Contacto</h3>";
                    echo "<p>Teléfono: <a href='tel:$resultado[telefono]'>$resultado[telefono]</a></p>";
                    echo "<p>Correo electrónico: <a href='mailto:$resultado[email]'>$resultado[email]</a></p>";
                    echo "<p>Provincia: $resultado[provincia]</p>";
                    echo "<h4>Titulación</h4>";
                    echo "<p>$resultado[titulacion]</p>";
                    echo "<h4>Experiencia</h4>";
                    echo "<p>$resultado[experiencia]</p>";
                    echo "<h4>Más información</h4>";
                    echo "<p>$resultado[masinfo]</p>";
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
<script src="js/jQuery.js"></script>
<script src="js/comun.js"></script>
