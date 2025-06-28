<?php
include("../auth/check.php");
include("../config/db.php");
include("../includes/header.php");

$message = "";


$livres = $db->query("SELECT * FROM livres WHERE quantite > 0 ORDER BY titre")->fetchAll();

$usagers = $db->query("SELECT * FROM usagers ORDER BY nom")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_livre = (int)$_POST["id_livre"];
    $id_usager = (int)$_POST["id_usager"];
    $date_emprunt = date("Y-m-d");
    $date_retour = $_POST["date_retour"];

    
    $emp = $db->prepare("INSERT INTO emprunts (id_livre, id_usager, date_emprunt, date_retour) VALUES (?, ?, ?, ?)");
    $ok = $emp->execute([$id_livre, $id_usager, $date_emprunt, $date_retour]);

  
    if ($ok) {
        $db->prepare("UPDATE livres SET quantite = quantite - 1 WHERE id = ?")->execute([$id_livre]);
            header("Location: /dev-web-2/Bibliotheque/emprunts/liste.php");
            exit();
    } else {
        $message = "Une erreur est survenue.";
    }
}
?>

<div class="box">
    <h2>Nouvel emprunt</h2>

    <?php 
        if (!empty($message)){  
        echo "<p style='color:red'>$message<p>";
        }
    ?>

    <form method="post" action="">
        <label>Livre à emprunter :</label><br>
        <select name="id_livre" required>
            <option value="">-- Choisir un livre --</option>
            <?php foreach ($livres as $livre): ?>
                <option value="<?= $livre['id'] ?>">
                    <?= htmlspecialchars($livre['titre']) ?> (<?= $livre['quantite'] ?> dispo)
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Usager :</label><br>
        <select name="id_usager" required>
            <option value="">-- Choisir un usager --</option>
            <?php foreach ($usagers as $usager): ?>
                <option value="<?= $usager['id'] ?>">
                    <?= htmlspecialchars($usager['nom']) ?> (<?= htmlspecialchars($usager['email']) ?>)
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Date de retour prévue :</label><br>
        <input type="date" name="date_retour" required><br><br>

        <input type="submit" style="font-weight:bold" value="Valider l'emprunt">
    </form>
</div>

<?php include("../includes/footer.php"); ?>
