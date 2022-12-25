<!DOCTYPE html>
<html>

<head>
    <title>Modifier | Animalerie</title>
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

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    if (isset($_POST['modifierAnimal'])) {
        if (
            !empty($_POST['nomAnimal']) and !empty($_POST['especeAnimal']) and !empty($_POST['criAnimal'])
            and !empty($_POST['proprietaireAnimal']) and !empty($_POST['ageAnimal']) and $_POST['ageAnimal'] > 0
        ) {
            $anml = new Animal;

            $anml->setId($id);
            $anml->setNom($_POST['nomAnimal']);
            $anml->setEspece($_POST['especeAnimal']);
            $anml->setCri($_POST['criAnimal']);
            $anml->setProprietaire($_POST['proprietaireAnimal']);
            $anml->setAge($_POST['ageAnimal']);

            $db = new PDO('mysql:host=localhost; dbname=grp-326_s3_progweb', 'grp-326', '5KVj34qD');
            $manager = new AnimauxManager($db);
            $manager->update($anml);

            echo "<p style='color: green'>SUCCÈS : Les données ont bien été modifiées.</p>";
        } else {
            echo "<p style='color: red'>ERREUR : Les données saisies sont incorrectes.</p>";
        }
    }

    $db = new PDO('mysql:host=localhost; dbname=grp-326_s3_progweb', 'grp-326', '5KVj34qD');
    $manager = new AnimauxManager($db);
    $animal = $manager->get((int) $id);

    $formulaire = new Formulaire('modifier.php?id=' . $id);

    $nom = new Champ('Nom', 'nomAnimal', 'text', $animal->getNom());
    $espece = new Champ('Espece', 'especeAnimal', 'text', $animal->getEspece());
    $cri = new Champ('Cri', 'criAnimal', 'text', $animal->getCri());
    $proprietaire = new Champ('Proprietaire', 'proprietaireAnimal', 'text', $animal->getProprietaire());
    $age = new Champ('Age', 'ageAnimal', 'number', $animal->getAge());
    $modification = new Champ('', 'modifierAnimal', 'submit', 'Modifier');

    $formulaire->add($nom);
    $formulaire->add($espece);
    $formulaire->add($cri);
    $formulaire->add($proprietaire);
    $formulaire->add($age);
    $formulaire->add($modification);

    echo '<h3>Modifier les données de l\'animal ' . $animal->getNom() . '</h3>';
    echo $formulaire->__toString();

    ?>

</body>

</html>