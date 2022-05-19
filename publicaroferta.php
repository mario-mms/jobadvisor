<?php
session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['cif'])){

    $cif=$_SESSION['cif'];

    $titulo=$_POST['titulo'];
    $salario=$_POST['salario'];
    $duracion=$_POST['duracion'];
    $descripcion=$_POST['descripcion'];
    $provincia=$_POST['provincia'];
    $horario=$_POST['horario'];
    $id_oferta=$_POST['id_oferta'];

    $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");

    $consulta0=$mysql->query("SELECT id_empresa FROM empresas WHERE cif='$cif'");
    $resultado0=$consulta0->fetch_assoc();
    $id_empresa=$resultado0["id_empresa"];

    $consulta=$mysql->query("SELECT * FROM ofertas WHERE id_oferta='$id_oferta'");
    if ($mysql->affected_rows == 0){
        $consulta2=$mysql->query("INSERT INTO ofertas (id_empresa,provincia,fecha_actual,titulo,salario,duracion,descripcion,horario) 
                            VALUES ('$id_empresa','$provincia',current_date,'$titulo','$salario','$duracion','$descripcion','$horario')");
        $mysql->close();
    }
    else{
        $resultado=$consulta->fetch_assoc();
        $id_oferta=$resultado["id_oferta"];
        $consulta31=$mysql->query("UPDATE ofertas SET fecha_actual=current_date WHERE id_oferta='$id_oferta'");
        $consulta32=$mysql->query("UPDATE ofertas SET provincia='$provincia' WHERE id_oferta='$id_oferta'");
        $consulta33=$mysql->query("UPDATE ofertas SET titulo='$titulo' WHERE id_oferta='$id_oferta'");
        $consulta34=$mysql->query("UPDATE ofertas SET salario='$salario' WHERE id_oferta='$id_oferta'");
        $consulta35=$mysql->query("UPDATE ofertas SET duracion='$duracion' WHERE id_oferta='$id_oferta'");
        $consulta36=$mysql->query("UPDATE ofertas SET descripcion='$descripcion' WHERE id_oferta='$id_oferta'");

        $mysql->close();
    }
    header("Location:misofertas.php");
}
else{
    header("Location:index.php");
}
?>