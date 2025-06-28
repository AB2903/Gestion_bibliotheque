<?php
    include_once ("auth/check.php");
    include_once ("config/db.php");
    include_once ("includes/header.php");

    $totalLivres = $db->query("SELECT COUNT(*) FROM livres")->fetchColumn();
    $totalUsagers = $db->query("SELECT COUNT(*) FROM usagers")->fetchColumn();
    $livresEmprunte = $db->query("SELECT COUNT(*) FROM emprunts WHERE rendu = FALSE")->fetchColumn();
    $auteurs = $db->query("SELECT DISTINCT auteur FROM livres WHERE auteur IS NOT NULL")->fetchAll();
?>


<h2 id="h2">Tableau de bord</h2>

<div class="dashbord">
    <div class="infos">
        <h3><i class="fa-solid fa-book" style="color: #f7f7f7;"></i> Livres enregistrés</h3>
        <p><?=$totalLivres?></p>
    </div>

    <div class="infos">
        <h3><i class="fa-solid fa-book" style="color: #f7f7f7;"></i> Livres empruntés</h3>
        <p><?=$livresEmprunte?></p>
    </div>

    <div class="infos">
        <h3><i class="fa-solid fa-user"></i> Usagers inscrits</h3>
        <p><?=$totalUsagers?></p>
    </div>

</div>

<?php
    include_once ("includes/footer.php");
?>