<?php
    session_start();
    if (isset($_SESSION["email"]) && isset($_SESSION["pass"]) && isset($_SESSION["nif"])){
        if (isset($_GET['id_opinion'])){
            $id_opinion=$_GET['id_opinion'];
            $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
            $consulta=$mysql->query("DELETE FROM respuestas WHERE id_opinion='$id_opinion'");
            $consulta2=$mysql->query("DELETE FROM opiniones WHERE id_opinion='$id_opinion'");
            $mysql->close();

            header("Location:misopiniones.php");
        }
    }
    else if (isset($_SESSION["email"]) && isset($_SESSION["pass"]) && isset($_SESSION["cif"])){
        if (isset($_GET['id_oferta'])){
            $id_oferta=$_GET['id_oferta'];
            $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
            $consulta=$mysql->query("DELETE FROM ofertas WHERE id_oferta='$id_oferta'");
            $mysql->close();

            header("Location:misofertas.php");
        }
    }
    else{
        header("Location:index.php");
    }
?>