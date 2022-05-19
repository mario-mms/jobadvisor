<?php
session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['nif'])){

        unset($_SESSION['email']);
        unset($_SESSION['pass']);
        unset($_SESSION['nif']);
        session_destroy();
        header("Location: index.php");
    }
    else if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['cif'])){

        unset($_SESSION['email']);
        unset($_SESSION['pass']);
        unset($_SESSION['cif']);
        session_destroy();
        header("Location:index.php");
}
?>