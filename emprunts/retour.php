<?php
include("../auth/check.php");
include("../config/db.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idEmprunt = (int)$_GET['id'];

    $emp = $db->prepare("SELECT id_livre FROM emprunts WHERE id = ? AND rendu = FALSE");
    $emp->execute([$idEmprunt]);
    $emprunt = $emp->fetch();

    if ($emprunt) {
        $idLivre = $emprunt['id_livre'];
        $update = $db->prepare("UPDATE emprunts SET rendu = TRUE WHERE id = ?");

        $update->execute([$idEmprunt]);

        $db->prepare("UPDATE livres SET quantite = quantite + 1 WHERE id = ?")
            ->execute([$idLivre]);
    }
}

header("Location: liste.php");
exit();
