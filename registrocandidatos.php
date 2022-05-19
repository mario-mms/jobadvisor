<?php
    session_start();
    if(isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['id_candidato'])==FALSE){
        $nombre=$_POST['nombre'];
        $apellido1=$_POST['apellido1'];
        $apellido2=$_POST['apellido2'];
        $nif=$_POST['nif'];
        $telefono=$_POST['telefono'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $passhash=password_hash($pass,PASSWORD_DEFAULT);

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta=$mysql->query("INSERT INTO candidatos (nombre,apellido1,apellido2,nif,telefono,email,password) 
                            VALUES ('$nombre','$apellido1','$apellido2','$nif','$telefono','$email','$passhash')");
        if ($mysql->affected_rows!==0){
            $_SESSION['email']=$email;
            $_SESSION['pass']=$passhash;
            $_SESSION['nif']=$nif;

            header("Location:cv.php");
        }
        else{
            header("Location:index.php");
        }
        $mysql->close();


    }
    else if(isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['nif']) && isset($_POST['email']) && isset($_POST['pass'])){
        $nombre=$_POST['nombre'];
        $apellido1=$_POST['apellido1'];
        $apellido2=$_POST['apellido2'];
        $nif=$_POST['nif'];
        $telefono=$_POST['telefono'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $passhash=password_hash($pass,PASSWORD_DEFAULT);
        $id_candidato=$_POST['id_candidato'];

        $_SESSION['email']=$email;
        $_SESSION['pass']=$passhash;
        $_SESSION['nif']=$nif;

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta1=$mysql->query("UPDATE candidatos SET nombre='$nombre' WHERE id_candidato='$id_candidato'");
        $consulta1=$mysql->query("UPDATE candidatos SET apellido1='$apellido1' WHERE id_candidato='$id_candidato'");
        $consulta1=$mysql->query("UPDATE candidatos SET apellido2='$apellido2' WHERE id_candidato='$id_candidato'");
        $consulta2=$mysql->query("UPDATE candidatos SET nif='$nif' WHERE id_candidato='$id_candidato'");
        $consulta3=$mysql->query("UPDATE candidatos SET telefono='$telefono' WHERE id_candidato='$id_candidato'");
        $consulta5=$mysql->query("UPDATE candidatos SET email='$email' WHERE id_candidato='$id_candidato'");
        $consulta6=$mysql->query("UPDATE candidatos SET password='$passhash' WHERE id_candidato='$id_candidato'");

        header("Location:candidatos.php");
    }
    else{
        header("ofertas:index.php");
    }
?>