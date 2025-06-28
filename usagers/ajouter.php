<?php
include("../auth/check.php");
include("../config/db.php");
include("../includes/header.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars(trim($_POST["nom"]));
    $email = htmlspecialchars(trim($_POST["email"]));

    if ((!empty($nom)) && (!empty($email))) {
        $sql = "INSERT INTO usagers (nom, email) VALUES (?, ?)";
        $rep = $db->prepare($sql);

        if ($rep->execute([$nom, $email])) {
            header("Location: /dev-web-2/Bibliotheque/usagers/lister.php");
            exit();
        } else {
            $message = "Erreur lors de l'ajout (email déjà utilisé ?)";
        }
    } else {
        $message = "Veuillez remplir tous les champs";
    }
}
?>

<div class="box">
  <h2>Ajouter un usager</h2>

  <?php 
    if (!empty($message)){
      echo "<p style='color:red'>$message</p>";
    }
  ?>

  <form method="post" action="">
      <label for="nom">Prénom - Nom<span style="color:red">*</span></label><br>
      <input type="text" name="nom" required><br><br>
      <label for="email">Email<span style="color:red">*</span></label><br>
      <input type="text" name="email"><br><br>
      <input type="submit" value="Ajouter l'usager">
  </form>
</div>

<?php include("../includes/footer.php"); ?>
