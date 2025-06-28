<?php
    include_once ("../auth/check.php");
    include_once ("../config/db.php");

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int)$_GET['id'];

        $sup = $db->prepare("DELETE FROM livres WHERE id = ?");
        $sup->execute([$id]);
    }

    header("Location: lister.php");
    exit();
?>