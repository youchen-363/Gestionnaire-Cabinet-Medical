<?php 
    session_start();
    $user = "";
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }

    function disconnect(){
        if (empty($_SESSION['user'])){
            header("Location: identification.php");
        }
            
        if (isset($_POST['disconnect'])){
            session_unset();
            header("Location: ./identification.php");
        }
    }
?>