<?php
include("../auth/check.php");
include("../config/db.php");
include("../includes/header.php");


$sqlEnCours = "
    SELECT e.id, l.titre, u.nom, u.email, e.date_emprunt, e.date_retour
    FROM emprunts e
    JOIN livres l ON e.id_livre = l.id
    JOIN usagers u ON e.id_usager = u.id
    WHERE e.rendu = FALSE
    ORDER BY e.date_emprunt DESC
";
$empruntsEnCours = $db->query($sqlEnCours)->fetchAll();

$sqlPasses = "
    SELECT e.id, l.titre, u.nom, u.email, e.date_emprunt, e.date_retour
    FROM emprunts e
    JOIN livres l ON e.id_livre = l.id
    JOIN usagers u ON e.id_usager = u.id
    WHERE e.rendu = TRUE
    ORDER BY e.date_emprunt DESC
";
$empruntsPasses = $db->query($sqlPasses)->fetchAll();
?>
<div style="width:200px; display:flex; justify-content: end;"><button class="btn"><a href="ajouter.php">Emprunter un livre</a></button></div>

<div class="box">
    
    <h2>Emprunts en cours</h2>

    <?php if (empty($empruntsEnCours)): ?>
        <p>Aucun emprunt en cours.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Livre</th>
                    <th>Usager</th>
                    <th>Date emprunt</th>
                    <th>Date retour prévue</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($empruntsEnCours as $e): ?>
                <tr>
                    <td><?= $e['id'] ?></td>
                    <td><?= htmlspecialchars($e['titre']) ?></td>
                    <td><?= htmlspecialchars($e['nom']) ?> (<?= htmlspecialchars($e['email']) ?>)</td>
                    <td><?= $e['date_emprunt'] ?></td>
                    <td><?= $e['date_retour'] ?></td>
                    <td>
                        <a href="retour.php?id=<?= $e['id'] ?>" style="text-decoration:none; color:#000;font-weight:bold; padding:4px; background-color:greenyellow; border-radius:8px" onclick="return confirm('Marquer ce livre comme rendu ?');">
                            Rendre le livre
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>


    <h2 style="margin-top:20px">Emprunts passés</h2>

    <?php if (empty($empruntsPasses)): ?>
        <p>Aucun emprunt passé.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Livre</th>
                    <th>Usager</th>
                    <th>Date emprunt</th>
                    <th>Date retour prévue</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($empruntsPasses as $e): ?>
                <tr>
                    <td><?= $e['id'] ?></td>
                    <td><?= htmlspecialchars($e['titre']) ?></td>
                    <td><?= htmlspecialchars($e['nom']) ?> (<?= htmlspecialchars($e['email']) ?>)</td>
                    <td><?= $e['date_emprunt'] ?></td>
                    <td><?= $e['date_retour'] ?></td>
                    <td style="font-weight:bold">Rendu</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- <button class="btn"><a href="ajouter.php">Emprunter un livre</a></button> -->
</div>

<?php include("../includes/footer.php"); ?>
