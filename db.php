<?php
    $db_name = "moviestar";
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";

    $conn = new PDO("mysql:dbname=$db_name;dbhost=$db_host", $db_user, $db_pass);

    //Habilitar Erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>