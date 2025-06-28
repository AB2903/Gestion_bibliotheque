<?php
    include_once ("../auth/check.php");
    include_once ("../config/db.php");
    include_once ("../includes/header.php");

    $sql = "SELECT * FROM livres ORDER BY id";
    $livres = $db->query($sql)->fetchAll();

?>


<div class="lister-livre">
    <h2>Liste des livres</h2>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année</th>
                <th>Disponible</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livres as $livre): ?>
            <tr>
                <td><?= $livre['id'] ?></td>
                <td><?= htmlspecialchars($livre['titre']) ?></td>
                <td><?= htmlspecialchars($livre['auteur']) ?></td>
                <td><?= $livre['annee'] ?></td>
                <td><?= ($livre['quantite'] > 0) ? "Oui" : "Non" ?></td>
                <td>
                    <a href="modifier.php?id=<?= $livre['id'] ?>"style="text-decoration:none; color:#fff; padding:6px; background-color:green; border-radius:10px">Modifier</a>  /
                    <a href="supprimer.php?id=<?= $livre['id'] ?>"style="text-decoration:none; color:#fff; padding:6px; background-color:red; border-radius:10px" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button class="btn" style="display: block;margin: 20px auto 0 auto;"><a href="ajouter.php">Ajouter un livre</a></button>

</div>


<?php
    include_once ("../includes/footer.php");
?>