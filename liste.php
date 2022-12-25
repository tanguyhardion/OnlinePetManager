<!DOCTYPE html>
<html>

<head>
    <title>Liste | Animalerie</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="menu">
        <ul>
            <a href="index.php">Accueil</a>
            <a href="liste.php">Liste des animaux</a>
            <a href="ajouter.php">Ajouter un animal</a>
            <a href="rechercher.php">Rechercher un animal</a>
            <a href="supprimer.php">Supprimer un animal</a>
        </ul>
    </div>

    <?php

    require("src/Animal.php");
    require("src/AnimauxManager.php");
    require("src/VueAnimal.php");

    $db = new PDO('mysql:host=localhost; dbname=grp-326_s3_progweb', 'grp-326', '5KVj34qD');
    $manager = new AnimauxManager($db);
    $listeAnimaux = $manager->getList();

    ?>

    <h3>Liste des animaux</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Espèce</th>
                <th>Cri</th>
                <th>Propriétaire</th>
                <th>Âge</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listeAnimaux as $animaux) {
                $vueAnimal = new VueAnimal($animaux);
                echo $vueAnimal->__toString();
            }
            ?>
        </tbody>
    </table>
</body>

</html>