<!DOCTYPE html>
<html>

<head>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ajouter | Animalerie</title>
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

    if (isset($_POST['ajouterAnimal'])) {
        if (
            !empty($_POST['nomAnimal']) and !empty($_POST['especeAnimal']) and !empty($_POST['criAnimal'])
            and !empty($_POST['proprietaireAnimal']) and isset($_POST['ageAnimal'])
            and ($_POST['ageAnimal'] == 0 or !empty($_POST['ageAnimal']))
        ) {
            $animal = new Animal;

            $animal->setNom($_POST['nomAnimal']);
            $animal->setEspece($_POST['especeAnimal']);
            $animal->setCri($_POST['criAnimal']);
            $animal->setProprietaire($_POST['proprietaireAnimal']);
            $animal->setAge($_POST['ageAnimal']);

            $db = new PDO('mysql:host=localhost; dbname=grp-326_s3_progweb', 'grp-326', '5KVj34qD');
            $manager = new AnimauxManager($db);
            $manager->add($animal);

            echo "<p style='color: green'>SUCCÈS : L'animal a bien été ajouté.</p>";
        } else {
            echo "<p style='color: red'>ERREUR : Les données saisies sont incorrectes.</p>";
        }
    }

    $formulaire = new Formulaire('#');

    $nom = new Champ('Nom', 'nomAnimal', 'text');
    $espece = new Champ('Espèce', 'especeAnimal', 'text');
    $cri = new Champ('Cri', 'criAnimal', 'text');
    $proprietaire = new Champ('Propriétaire', 'proprietaireAnimal', 'text');
    $age = new Champ('Âge', 'ageAnimal', 'number');
    $ajout = new Champ('', 'ajouterAnimal', 'submit', 'Ajouter');

    $formulaire->add($nom);
    $formulaire->add($espece);
    $formulaire->add($cri);
    $formulaire->add($proprietaire);
    $formulaire->add($age);
    $formulaire->add($ajout);

    echo '<h3>Ajouter un animal</h3>';
    echo $formulaire->__toString();

    ?>

</body>

</html>