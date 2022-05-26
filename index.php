<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['nif'])){
        header("Location:ofertas.php");
    }
    else if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['cif'])){
        header("Location:candidatos.php");
    }
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JOBADVISOR</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/comun.css">
</head>
<body>
    <header>
        <a href="index.php"><img id="logo" src="img/logopeq.png" alt="logo"></a>
    </header>
    <main>
        <section id="accesos">
            <div id="candidatos">
                Acceso candidatos
            </div>
            <div id="empresas">
                Acceso empresas
            </div>
        </section>
        <section id="iniciocandidatos">
            <div>
                <h2>Accede como candidato</h2>
                <form  action="iniciosesion.php" method="post" id="inicio">
                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="email" required placeholder="pepito@correo.com"><br>
                    <label for="pass">Contraseña</label><br>
                    <input type="password" name="pass" id="pass" required><br>
                    <button type="submit" id="iniciosesion">Iniciar sesión</button>
                    <p id="aviso"></p>
                </form>
            </div>
            <div>
                <h2>¿Eres nuevo?</h2>
                <h3>Añade tu CV</h3>
                <p>Muestra a las empresas todos tus datos, cuantos más mejor</p>
                <h3>Busca ofertas</h3>
                <p>Encuentra las ofertas que más te interesen y contacta con las empresas</p>
                <h3>Danos tu opinión</h3>
                <p>Es útil tu experiencia sobre las empresas</p>
                <button type="submit" id="registrar">Registrarse</button>
            </div>
        </section>
        <section id="regcandidatos">
            <h2>Regístrate como candidato</h2>
            <h3>Los siguientes campos son obligatorios</h3>
            <form action="registrocandidatos.php" method="post">
                <label for="nombre">Nombre</label><br>
                <input type="text" name="nombre" id="nombrecand" required autocapitalize="sentences"><br>
                <label for="apellido1">Primer Apellido</label><br>
                <input type="text" name="apellido1" id="apellido1" required autocapitalize="sentences"><br>
                <label for="apellido2">Segundo Apellido</label><br>
                <input type="text" name="apellido2" id="apellido2" required autocapitalize="sentences"><br>
                <label for="nif">NIF/NIE</label><br>
                <input type="text" name="nif" id="nif" required maxlength="9"><br>
                <label for="telefono">Teléfono de contacto</label><br>
                <input type="tel" name="telefono" id="telefonocand" required maxlength="9" pattern="[0-9]{9}"><br>
                <label for="email">Correo electrónico</label><br>
                <input type="email" name="email" id="email3" required><br>
                <label for="pass">Contraseña</label><br>
                <input type="password" name="pass" id="pass3" required><br>
                <p id="aviso3" style="color: red"></p>
                <button type="submit" id="registrocandidatos">Registrar</button>
            </form>
        </section>
        <section id="inicioempresas">
            <div>
                <h2>Accede como empresa</h2>
                <form  action="iniciosesion.php" method="post">
                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="email2" placeholder="pepito@correo.com"><br>
                    <label for="pass">Contraseña</label><br>
                    <input type="password" name="pass" id="pass2"><br>
                    <button type="submit" id="iniciosesion2">Iniciar sesión</button>
                    <p id="aviso2"></p>
                </form>
            </div>
            <div>
                <h2>¿Quieres unirte?</h2>
                <h3>Añade los datos de tu empresa</h3>
                <p>Proporciona toda la información de tu empresa</p>
                <h3>Publica ofertas</h3>
                <p>Anuncia tus ofertas de empleo para que los candidatos puedan contactar contigo</p>
                <h3>Busca candidatos</h3>
                <p>Podrás encontrar los candidatos que más te interesen</p>
                <button type="submit" id="daralta">Darse de alta</button>
            </div>
        </section>
        <section id="regempresas">
            <h2>Date de alta como empresa</h2>
            <h3>Los siguientes campos son obligatorios</h3>
            <form action="registroempresas.php" method="post">
                <label for="nombre">Nombre de la empresa</label><br>
                <input type="text" name="nombre" id="nombreemp" required autocapitalize="sentences"><br>
                <label for="cif">CIF</label><br>
                <input type="text" name="cif" id="cif" required maxlength='9'><br>
                <label for="telefono">Teléfono de contacto</label><br>
                <input type="tel" name="telefono" id="telefonoemp" required maxlength="9""><br>
                <label for="informacion">Información adicional</label><br>
                <textarea name="informacion" id="informacion" rows="4"></textarea><br>
                <label for="email">Correo electrónico</label><br>
                <input type="email" name="email" id="email4" required><br>
                <label for="pass">Contraseña</label><br>
                <input type="password" name="pass"  id="pass4" required><br>
                <p id="aviso4" style="color: red"></p>
                <button type="submit" id="registroempresas">Darse de alta</button>
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
<script src="js/index.js"></script>
<script src="js/comun.js"></script>