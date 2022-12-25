<!DOCTYPE html>
<html>

<head>
    <title>Supprimer | Animalerie</title>
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
    require("src/Champ.php");
    require("src/Formulaire.php");

    if (isset($_GET['nom'])) {
        $nom = $_GET['nom'];

        $animal = new Animal;
        $animal->setNom($nom);

        $db = new PDO('mysql:host=localhost; dbname=grp-326_s3_progweb', 'grp-326', '5KVj34qD');
        $manager = new AnimauxManager($db);
        $manager->remove($animal);

        header("Location: liste.php");
    } else {
        $formulaire = new Formulaire('#');

        $nom = new Champ('Entrer le nom de l\'animal à supprimer :', 'nomAnimalSupprime', 'text');
        $suppression = new Champ('', 'supprimerAnimal', 'submit', 'Supprimer');

        $formulaire->add($nom);
        $formulaire->add($suppression);

        echo '<h3>Supprimer un animal</h3>';
        echo $formulaire->__toString();

        if (isset($_POST['supprimerAnimal'])) {
            if (!empty($_POST['nomAnimalSupprime'])) {
                $animal = new Animal;
                $animal->setNom($_POST['nomAnimalSupprime']);

                $db = new PDO('mysql:host=localhost; dbname=grp-326_s3_progweb', 'grp-326', '5KVj34qD');
                $manager = new AnimauxManager($db);
                $manager->remove($animal);
            } else {
                echo "<p style='color: red'>ERREUR : Le champ doit être rempli.</p>";
            }
        }
    }
    ?>


</body>

</html>