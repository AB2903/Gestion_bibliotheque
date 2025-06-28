<?php
    include_once ("../auth/check.php");
    include_once ("../config/db.php");
    include_once ("../includes/header.php");
    
    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titre = htmlspecialchars(trim($_POST['titre']));
        $auteur = htmlspecialchars(trim($_POST['auteur']));
        $annee = htmlspecialchars(trim($_POST['annee']));
        $quantite = (int)$_POST["quantite"];   

        if (!empty($titre) && $quantite > 0) {

            $sql = "INSERT INTO livres (titre, auteur, annee, quantite) VALUES (?, ?, ?, ?)";

            $req = $db->prepare($sql);
            if ($req->execute([$titre, $auteur, $annee, $quantite])) {
                header("Location: /dev-web-2/Bibliotheque/livres/lister.php");
                exit();
            } else{
                $message = "Une erreur est survenue lors de l'ajout";
            }
        } else{
            $message = "Veuillez remplir tous les champs";
        }
        
    }
?>




<div class="box">
    <h2>Ajouter un livre</h2>

    <?php
        if (!empty($message)) {
            echo "<p style='color:red'>$message</p>";
        }
    ?>

    <form action="" method="post">
        <label for="titre">Titre du livre<span style="color:red">*</span></label>
        <input type="text" name="titre" required><br><br>
        <label for="auteur">Auteur<span style="color:red">*</span></label>
        <input type="text" name="auteur" required><br><br>
        <label for="annee">Année de publication<span style="color:red">*</span></label>
        <input type="number" name="annee" min="0" max="<?=date('Y')?>"required><br><br>
        <label for="quantite">Quantité (nombre d'exemplaires)</label>
        <input type="number" name="quantite" min="1" value="1" required><br><br>
        <input type="submit" style="font-weight:bold" value="Ajouter le livre">
    </form>
</div>


<?php
    include_once ("../includes/footer.php");
?>