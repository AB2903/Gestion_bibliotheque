<?php
include("../auth/check.php");
include("../config/db.php");
include("../includes/header.php");

$usagers = $db->query("SELECT * FROM usagers ORDER BY id")->fetchAll();
?>

<div class="box">
    <h2>Liste des usagers</h2>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usagers as $usager): ?>
                <tr>
                    <td><?= $usager['id'] ?></td>
                    <td><?= htmlspecialchars($usager['nom']) ?></td>
                    <td><?= htmlspecialchars($usager['email']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
    </table>
    <div class="btn">
            <a href="ajouter.php">Ajouter un usager</a>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
