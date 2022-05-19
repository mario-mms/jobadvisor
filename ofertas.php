<?php
    session_start();
    if (isset($_SESSION["email"]) && isset($_SESSION["pass"]) && isset($_SESSION["nif"])){
        if ($_POST['provincia']=='all' && isset($_POST['oferta'])){

            $oferta=$_POST['oferta'];
            $provincia=$_POST['provincia'];

            $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
            $consulta=$mysql->query("SELECT * FROM ofertas JOIN empresas USING (id_empresa) WHERE titulo like '%$oferta%'");
            $resultado=$consulta->fetch_assoc();
        }
        else if ($_POST['oferta']=='' && isset($_POST['provincia'])){
            $oferta=$_POST['oferta'];
            $provincia=$_POST['provincia'];

            $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
            $consulta=$mysql->query("SELECT * FROM ofertas JOIN empresas USING (id_empresa) WHERE provincia = '$provincia'");
            $resultado=$consulta->fetch_assoc();
        }
        else if(isset($_POST['provincia']) && isset($_POST['oferta'])){

            $provincia=$_POST['provincia'];
            $oferta=$_POST['oferta'];
            $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
            $consulta=$mysql->query("SELECT * FROM ofertas JOIN empresas USING (id_empresa) WHERE provincia = '$provincia' 
                                    AND titulo like '%$oferta%'");
            $resultado=$consulta->fetch_assoc();
        }
        else{
            $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
            $consulta=$mysql->query("SELECT * FROM ofertas JOIN empresas using (id_empresa)");
            $resultado=$consulta->fetch_assoc();
        }

        $mysql->close();
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
    <title>Buscar ofertas</title>
    <link rel="stylesheet" href="css/estilos.css">
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
            <form action="ofertas.php" method="post">
                <label for="oferta">Buscar ofertas de...</label>
                <input type="text" name="oferta" id="oferta" value="">
                <label for="provincia">Provincia</label>
                <select name="provincia" id="provincia" >
                    <option value="">Cargando...</option>
                </select>
                <button type="submit">Buscar</button>
            </form>
        </section>
        <section id="ofertas">
            <?php
                while ($resultado){
                    echo "<div>";
                    echo "<h2><a href='opinar.php?id_empresa=$resultado[id_empresa]'>$resultado[nombre]</a></h2>";
                    echo "<h2>Puesto: $resultado[titulo]</h2>";
                    echo "<h3>Contacto</h3>";
                    echo "<p>Teléfono: <a href='tel:$resultado[telefono]'>$resultado[telefono]</a></p>";
                    echo "<p>Correo electrónico: <a href='mailto:$resultado[email]'>$resultado[email]</a></p>";
                    echo "<p>Provincia: $resultado[provincia]</p>";
                    echo "<p>Fecha de publicación: $resultado[fecha_actual]</p>";
                    echo "<p>Salario: $resultado[salario]</p>";
                    echo "<p>Horario: $resultado[horario]</p>";
                    echo "<p>Duración: $resultado[duracion]</p>";
                    echo "<p>Descripción del puesto: $resultado[descripcion]</p>";
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
<script>
    $(function (){
        let peticion=$.ajax({
            "url":"https://public.opendatasoft.com/api/records/1.0/search/?dataset=provincias-espanolas&sort=provincia&rows=52",
            "method":"get",
            "dataType":"json"
        });
        peticion.done(function (data){
            $("#provincia").html("<option value='all' selected>Selecciona la provincia</option>");
            for (let provincias of data.records){
                let provincia=provincias.fields.texto;
                $("#provincia").append(`<option value="${provincia}">${provincia}</option>`);
            }
        });
    });
</script>
