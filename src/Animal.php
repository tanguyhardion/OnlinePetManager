<?php

declare(strict_types = 1);

class Animal
{
    private $_id;
    private $_nom;
    private $_espece;
    private $_cri;
    private $_proprietaire;
    private $_age;

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0)
        {
            $this->_id = $id;
        }
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function setNom($nom)
    {
        $nom = (string) $nom;
        if ($nom != null)
        {
            $this->_nom = $nom;
        }
    }

    public function getEspece()
    {
        return $this->_espece;
    }

    public function setEspece($espece)
    {
        $espece = (string) $espece;
        if ($espece != null)
        {
            $this->_espece = $espece;
        }
    }

    public function getCri()
    {
        return $this->_cri;
    }

    public function setCri($cri)
    {
        $cri = (string) $cri;
        if ($cri != null)
        {
            $this->_cri = $cri;
        }
    }

    public function getProprietaire()
    {
        return $this->_proprietaire;
    }
    
    public function setProprietaire($proprietaire)
    {
        $proprietaire = (string) $proprietaire;
        if ($proprietaire != null)
        {
            $this->_proprietaire = $proprietaire;
        }
    }

    public function getAge()
    {
        return $this->_age;
    }

    public function setAge($age)
    {
        $age = (string) $age;
        if ($age != null and $age >= 0)
        {
            $this->_age = $age;
        }
    }

    public function __toString()
    {
        return "<p style='background-color: #6F8FAF; color: white;
        width: fit-content; border-radius: 10px; padding: 15px;'><b>Id :</b> " .
        $this->_id . "<br><b>Nom :</b> " . $this->_nom . 
        "<br><b>Espèce :</b> " . $this->_espece . "<br><b>Cri :</b> " . $this->_cri .  
        "<br><b>Propriétaire :</b> " . $this-> _proprietaire . "<br><b>Âge :</b> " . $this->_age . "<br></p>";
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

}
