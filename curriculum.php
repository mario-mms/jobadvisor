<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['nif'])){

        $experiencia=$_POST['experiencia'];
        $titulacion=$_POST['titulacion'];
        $mas=$_POST['mas'];
        $id_candidato=$_POST['id_candidato'];
        $provincia=$_POST['provincia'];

        $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
        $consulta=$mysql->query("SELECT * FROM cv where id_candidato='$id_candidato'");
        if ($mysql->affected_rows == 0){
            $consulta21=$mysql->query("INSERT INTO cv (id_candidato,fecha_actual,provincia) VALUES ('$id_candidato',current_date ,'$provincia')");
            $consulta22=$mysql->query("SELECT id_cv FROM cv WHERE id_candidato='$id_candidato'");
            $resultado=$consulta22->fetch_assoc();
            $id_cv=$resultado["id_cv"];
            $consulta23=$mysql->query("INSERT INTO experiencia (id_cv,experiencia) VALUES ('$id_cv','$experiencia')");
            $consulta24=$mysql->query("INSERT INTO titulacion (id_cv,titulacion) VALUES ('$id_cv','$titulacion')");
            $consulta25=$mysql->query("INSERT INTO masinfo (id_cv,masinfo) VALUES ('$id_cv','$mas')");

            $mysql->close();
        }
        else{
            $resultado=$consulta->fetch_assoc();
            $id_cv=$resultado["id_cv"];
            $consulta31=$mysql->query("UPDATE cv SET fecha_actual=current_date WHERE id_cv='$id_cv'");
            $consulta32=$mysql->query("UPDATE cv SET provincia='$provincia' WHERE id_cv='$id_cv'");
            $consulta33=$mysql->query("UPDATE experiencia SET experiencia='$experiencia' WHERE id_cv='$id_cv'");
            $consulta34=$mysql->query("UPDATE titulacion SET titulacion='$titulacion' WHERE id_cv='$id_cv'");
            $consulta35=$mysql->query("UPDATE masinfo SET masinfo='$mas' WHERE id_cv='$id_cv'");

            $mysql->close();
        }
        header("Location:ofertas.php");
    }
    else{
        header("Location:index.php");
    }
?>