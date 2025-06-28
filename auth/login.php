<?php
    session_start();

    require_once("../config/db.php");

    $erreur = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        $rep = $db->prepare("SELECT * FROM administrateur WHERE username = ? AND password = ?");
        $rep->execute([$username, $password]);

        $admin = $rep->fetch();

        if ($admin) {
            $_SESSION["admin"] = $admin["username"];
            header("Location: ../index.php");
            exit();
        } else {
            $erreur = "Nom d'utilisateur ou mot de passe incorrect";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Connexion Bibliotheque</title>
    <style>
        body{
            display:flex;
            justify-content:center;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Connexion Administrateur</h2>
        <?php 
            if(!empty($erreur)){
                echo "<p style='color:red'>$erreur</p>";
            } 
        ?>

        <form action="" method="post">
            <label for="username">Administrateur</label>
            <input type="text" name="username" required><br><br>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Se Connecter" style="font-weight:bolder">
        </form>
    </div>
</body>
</html>