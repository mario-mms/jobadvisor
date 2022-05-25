<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ofertas externas</title>
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
        <h1 id="eslogan">Ofertas de Castilla y León</h1>
        <section id="buscador">
            <label for="cyl">Provincia</label>
            <select name="provincia" id="cyl">
                <option value="" selected disabled>Selecciona una provincia</option>
                <option value="Ávila">Ávila</option>
                <option value="Burgos">Burgos</option>
                <option value="León">León</option>
                <option value="Palencia">Palencia</option>
                <option value="Salamanca">Salamanca</option>
                <option value="Segovia">Segovia</option>
                <option value="Soria">Soria</option>
                <option value="Valladolid">Valladolid</option>
                <option value="Zamora">Zamora</option>
                <option value="Otra">Otra</option>
            </select>
        </section>
        <section id="paginacion">
        </section>
        <section id="ofertas">

        </section>
    </main>
    <footer>

    </footer>
</body>
</html>
<script src="js/jQuery.js"></script>
<script src="js/comun.js"></script>
<script src="js/ofertasexternas.js"></script>