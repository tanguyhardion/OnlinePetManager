<?php

declare(strict_types = 1);

class VueAnimal{
    private $animal;

    function __construct(Animal $animal)
    {
        $this->animal = $animal;
    }

    public function __toString(){
        return 
        '<tr> 
        <td>' . $this->animal->getId() . '</td>
        <td>' . $this->animal->getNom() . '</td>
        <td>' . $this->animal->getEspece() .'</td>
        <td>' . $this->animal->getCri() . '</td>
        <td>' . $this->animal->getProprietaire() . '</td>
        <td>' . $this->animal->getAge() . '</td>
        <td>
        <a href="modifier.php?id=' . $this->animal->getId() . '">
        <input type="submit" name="modifierAnimal" value="Modifier">
        </a>
        </td>
        <td>
        <a href="supprimer.php?nom=' . $this->animal->getNom() . '">
        <input type="submit" name="supprimerAnimal" value="Supprimer"
        onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet animal?\')">
        </a>
        </td>
        </tr>';
    }

}

?>