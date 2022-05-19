<?php
    session_start();
    header("Content-Type:application/json;charset=utf-8");
    $mysql=new mysqli("localhost","jobadvisor","jobadvisor","jobadvisor");
    if (isset($_POST['email']) && isset($_POST['pass'])){
        $email=$_POST['email'];
        $pass=$_POST['pass'];

        $consulta=$mysql->query("select count(*) as registro,password,nif from candidatos where email='$email'");
        $resultado=$consulta->fetch_assoc();
        $passhash=$resultado["password"];
        $nif=$resultado["nif"];

        if ($resultado["registro"]==1 && password_verify($pass,$passhash)) {
            $_SESSION["email"] = $email;
            $_SESSION["pass"] = $pass;
            $_SESSION["nif"] = $nif;

            echo '{"correcto":"candidato"}';

        }
        else{
            echo '{"correcto":"no"}';
        }
    }
    else if (isset($_POST['email2']) && isset($_POST['pass2'])){
        $email2=$_POST['email2'];
        $pass2=$_POST['pass2'];

        $consulta2=$mysql->query("select count(*) as registro,password,cif from empresas where email='$email2'");
        $resultado2=$consulta2->fetch_assoc();
        $passhash2=$resultado2["password"];
        $cif=$resultado2["cif"];

        if ($resultado2["registro"]==1 && password_verify($pass2,$passhash2)) {
                $_SESSION["email"] = $email2;
                $_SESSION["pass"] = $pass2;
                $_SESSION["cif"] = $cif;

                echo '{"correcto":"empresa"}';

            }
            else{
                echo '{"correcto":"no"}';
            }
        }
?>