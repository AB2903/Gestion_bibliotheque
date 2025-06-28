<?php
include("../auth/check.php");
include("../config/db.php");
include("../includes/header.php");


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: lister.php");
    exit();
}

$id = (int)$_GET['id'];
$message = "";


$sel = $db->prepare("SELECT * FROM livres WHERE id = ?");
$sel->execute([$id]);
$livre = $sel->fetch();


if (!$livre) {
    echo "<p style='color:red;'>Livre introuvable.</p>";
    include("../includes/footer.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = htmlspecialchars(trim($_POST["titre"]));
    $auteur = htmlspecialchars(trim($_POST["auteur"]));
    $annee = htmlspecialchars(trim($_POST["annee"]));
    $quantite = htmlspecialchars(trim((int)$_POST["quantite"]));  

    if (!empty($titre)) {
        $sql = "UPDATE livres SET titre = ?, auteur = ?, annee = ?, quantite = ? WHERE id = ?";
        $sel = $db->prepare($sql);

        if ($sel->execute([$titre, $auteur, $annee, $quantite, $id])) {
            header("Location: lister.php");
            exit();
        } else {
            $message = "Erreur lors de la modification";
        }
    } else {
        $message = "Remplissez tous les champs";
    }
}
?>

<div class="box">
    <h2>Modifier le livre</h2>

    <?php if (!empty($message)) echo "<p style='color:red;'>$message</p>"; ?>

    <form action="" method="post">
        <label for="titre">Titre<span style="color:red">*</span></label>
        <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required><br><br>
        <label for="auteur">Auteur<span style="color:red">*</span></label>
        <input type="text" name="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>" required><br><br>
        <label for="annee">Annee<span style="color:red">*</span></label>
        <input type="text" name="annee" value="<?= htmlspecialchars($livre['annee']) ?>" required><br><br>
        <label for="quantite">Quantité (nombre d'exemplaires)</label>
        <input type="number" name="quantite" min="1" value="1" required><br><br>
        <input type="submit" value="Enregistrer les modifications">
    </form>
</div>

    

<?php include("../includes/footer.php"); ?>