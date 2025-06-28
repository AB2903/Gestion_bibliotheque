<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $db = new PDO("mysql:host=$servername;dbname=bibliotheque", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Reussie !!!";
    } catch (PDOException $e) {
        echo "Erreur de connexion : ". $e->getMessage();
    }
?>