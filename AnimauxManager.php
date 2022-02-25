<?php

declare(strict_types = 1);

class AnimauxManager
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function get(int $id)
    {
        $q = $this->_db->query('SELECT id, nom, espece, cri, proprietaire, age 
        FROM animaux WHERE id = ' . $id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        $animal = new Animal;
        $animal->hydrate($donnees);

        return $animal;
    }

    public function getList()
    {
        $animaux = array();

        $q = $this->_db->query('SELECT id, nom, espece, cri, proprietaire, age 
        FROM animaux ORDER BY id');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $animal = new Animal;
            $animal->hydrate($donnees);
            $animaux[] = $animal;
        }

        return $animaux;
    }

    public function add(Animal $animal)
    {
        $q = $this->_db->prepare('INSERT INTO animaux SET 
        nom = :nom,
        espece = :espece,
        cri = :cri,
        proprietaire = :proprietaire,
        age = :age');

        $q->bindValue(':nom', $animal->getNom());
        $q->bindValue(':espece', $animal->getEspece());
        $q->bindValue(':cri', $animal->getCri());
        $q->bindValue(':proprietaire', $animal->getProprietaire());
        $q->bindValue(':age', $animal->getAge());

        $q->execute();
    }

    public function update(Animal $animal)
    {
        $q = $this->_db->prepare('UPDATE animaux SET
        nom = :nom,
        espece = :espece,
        cri = :cri,
        proprietaire = :proprietaire,
        age = :age 
        WHERE id = ' . $animal->getId());

        $q->bindValue(':nom', $animal->getNom());
        $q->bindValue(':espece', $animal->getEspece());
        $q->bindValue(':cri', $animal->getCri());
        $q->bindValue(':proprietaire', $animal->getProprietaire());
        $q->bindValue(':age', $animal->getAge());

        $q->execute();
    }

    public function search(Animal $animal)
    {
        $nom = $animal->getNom();
        $espece = $animal->getEspece();
        $cri = $animal->getCri();
        $proprietaire = $animal->getProprietaire();
        $age = $animal->getAge();

        $s = "SELECT * FROM animaux";

        $filtres = array();
        if(!empty($nom))
        {
            $filtres[] = "nom='$nom'";
        }
        if(!empty($espece))
        {
            $filtres[] = "espece='$espece'";
        }
        if(!empty($cri))
        {
            $filtres[] = "cri='$cri'";
        }
        if(!empty($proprietaire))
        {
            $filtres[] = "proprietaire='$proprietaire'";
        }
        if(!empty($age))
        {
            $filtres[] = "age='$age'";
        }

        $q = $s;
        $query = $this->_db->prepare($q);
        if (count($filtres) > 0)
        {
            $q .= " WHERE " . implode(' AND ', $filtres);
            $query = $this->_db->prepare($q);
            $query->execute();
        }
        

        while ($donnees = $query->fetch(PDO::FETCH_ASSOC))
        {
            $animal->hydrate($donnees);
            echo $animal->__toString();
        }

        $result = $query->rowCount();
        if ($result == 0)
        {
            echo "<p>Aucun animal trouvé.</p>";
        }
    }

    public function remove(Animal $animal)
    {
        $nom = $animal->getNom();

        $q = $this->_db->query("DELETE FROM animaux WHERE
        nom = '$nom'");

        $result = $q->rowCount();
        if ($result != 0)
        {
            echo "<p style='color: green'>SUCCÈS : L'animal a été supprimé.</p>";
        }
        else
        {
            echo "<p style='color: red'>ERREUR : Le nom saisi est incorrect.</p>";
        }
    }
}

?>