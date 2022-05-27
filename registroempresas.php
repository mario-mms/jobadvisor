<?php
    session_start();
    header("Content-Type:application/json;charset=utf-8");
    if (isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['id_empresa'])==FALSE){
        $nombre=filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
        $cif=filter_var($_POST['cif'],FILTER_SANITIZE_STRING);
        $telefono=$_POST['telefono'];
        $informacion=filter_var(nl2br($_POST['nombre']),FILTER_SANITIZE_STRING);
        $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $pass=$_POST['pass'];
        $passhash=password_hash($pass,PASSWORD_DEFAULT);

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta0=$mysql->query("SELECT count(*) as registro FROM candidatos WHERE email='$email'");
        $resultado0=$consulta0->fetch_assoc();
        $consulta1=$mysql->query("SELECT count(*) as registro FROM empresas WHERE email='$email'");
        $resultado1=$consulta1->fetch_assoc();
        $consulta00=$mysql->query("SELECT count(*) as registro FROM empresas WHERE cif='$cif'");
        $resultado00=$consulta00->fetch_assoc();
        if ($resultado0["registro"]==1 OR $resultado1["registro"]==1){
            echo '{"existe":"si"}';
        }
        else if($resultado00['registro']==1){
            echo '{"existe":"cif"}';
        }
        else{
            $consulta = $mysql->query("INSERT INTO empresas (nombre,cif,telefono,informacion,email,password) 
                                VALUES ('$nombre','$cif','$telefono','$informacion','$email','$passhash')");

            if ($mysql->affected_rows !== 0) {
                $_SESSION['email'] = $email;
                $_SESSION['pass'] = $passhash;
                $_SESSION['cif'] = $cif;

                header("Location:candidatos.php");
            }
        }
    }
    else if(isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['cif']) && isset($_POST['id_empresa'])){
        $nombre=filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
        $telefono=$_POST['telefono'];
        $informacion=nl2br($_POST['informacion']);
        $pass=$_POST['pass'];
        $passhash=password_hash($pass,PASSWORD_DEFAULT);
        $id_empresa=$_POST['id_empresa'];

        $_SESSION['pass']=$passhash;

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta1=$mysql->query("UPDATE empresas SET nombre='$nombre' WHERE id_empresa='$id_empresa'");
        $consulta3=$mysql->query("UPDATE empresas SET telefono='$telefono' WHERE id_empresa='$id_empresa'");
        $consulta4=$mysql->query("UPDATE empresas SET informacion='$informacion' WHERE id_empresa='$id_empresa'");
        $consulta6=$mysql->query("UPDATE empresas SET password='$passhash' WHERE id_empresa='$id_empresa'");

        header("Location:candidatos.php");
    }
    else{
        header("Location:index.php");
    }
?>