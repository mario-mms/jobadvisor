<?php
    session_start();
    if (isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['id_empresa'])==FALSE){
        $nombre=$_POST['nombre'];
        $cif=$_POST['cif'];
        $telefono=$_POST['telefono'];
        $informacion=$_POST['informacion'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $passhash=password_hash($pass,PASSWORD_DEFAULT);

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta=$mysql->query("INSERT INTO empresas (nombre,cif,telefono,informacion,email,password) 
                                VALUES ('$nombre','$cif','$telefono','$informacion','$email','$passhash')");

        if ($mysql->affected_rows!==0){
            $_SESSION['email']=$email;
            $_SESSION['pass']=$passhash;
            $_SESSION['cif']=$cif;

            header("Location:misofertas.php");
        }

    }
    else if(isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['cif']) && isset($_POST['email']) && isset($_POST['pass'])){
        $nombre=$_POST['nombre'];
        $cif=$_POST['cif'];
        $telefono=$_POST['telefono'];
        $informacion=$_POST['informacion'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $passhash=password_hash($pass,PASSWORD_DEFAULT);
        $id_empresa=$_POST['id_empresa'];

        $_SESSION['email']=$email;
        $_SESSION['pass']=$passhash;
        $_SESSION['cif']=$cif;

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta1=$mysql->query("UPDATE empresas SET nombre='$nombre' WHERE id_empresa='$id_empresa'");
        $consulta2=$mysql->query("UPDATE empresas SET cif='$cif' WHERE id_empresa='$id_empresa'");
        $consulta3=$mysql->query("UPDATE empresas SET telefono='$telefono' WHERE id_empresa='$id_empresa'");
        $consulta4=$mysql->query("UPDATE empresas SET informacion='$informacion' WHERE id_empresa='$id_empresa'");
        $consulta5=$mysql->query("UPDATE empresas SET email='$email' WHERE id_empresa='$id_empresa'");
        $consulta6=$mysql->query("UPDATE empresas SET password='$passhash' WHERE id_empresa='$id_empresa'");

        header("Location:misofertas.php");
    }
    else{
        header("Location:index.php");
    }
?>