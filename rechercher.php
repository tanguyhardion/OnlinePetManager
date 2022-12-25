<!DOCTYPE html>
<html>

<head>
    <title>Rechercher | Animalerie</title>
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

    $formulaire = new Formulaire('#');

    $nom = new Champ('Nom :', 'nomAnimalRecherche', 'text');
    $espece = new Champ('Espèce :', 'especeAnimalRecherche', 'text');
    $cri = new Champ('Cri :', 'criAnimalRecherche', 'text');
    $proprietaire = new Champ('Propriétaire :', 'proprietaireAnimalRecherche', 'text');
    $age = new Champ('Âge :', 'ageAnimalRecherche', 'text');
    $recherche = new Champ('', 'rechercherAnimal', 'submit', 'Rechercher');

    $formulaire->add($nom);
    $formulaire->add($espece);
    $formulaire->add($cri);
    $formulaire->add($proprietaire);
    $formulaire->add($age);
    $formulaire->add($recherche);

    echo '<h3>Rechercher un animal</h3>';
    echo '<p>Entrer les données de l\'animal à rechercher (remplir au minimum un champ) :</p>';
    echo $formulaire->__toString();

    if (isset($_POST['rechercherAnimal'])) {
        $animal = new Animal;
        if (!empty($_POST['nomAnimalRecherche'])) {
            $animal->setNom($_POST['nomAnimalRecherche']);
        } else if (!empty($_POST['especeAnimalRecherche'])) {
            $animal->setEspece($_POST['especeAnimalRecherche']);
        } else if (!empty($_POST['criAnimalRecherche'])) {
            $animal->setCri($_POST['criAnimalRecherche']);
        } else if (!empty($_POST['proprietaireAnimalRecherche'])) {
            $animal->setProprietaire($_POST['proprietaireAnimalRecherche']);
        } else if (!empty($_POST['ageAnimalRecherche'])) {
            $animal->setAge($_POST['ageAnimalRecherche']);
        }

        $db = new PDO('mysql:host=localhost; dbname=grp-326_s3_progweb', 'grp-326', '5KVj34qD');
        $manager = new AnimauxManager($db);
        $manager->search($animal);
    }

    ?>

</body>

</html>