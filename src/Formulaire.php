<?php

declare(strict_types = 1);

class Formulaire
{
    private $champs;
    private $action;
   
    function __construct(string $action)
    {
        $this->champs = array();
        $this->action = $action;
    }

    public function __toString()
    {
        $s = "";
        $s .= "<form action=\"".$this->action."\" method=\"POST\">\n";
        foreach ($this->champs as $valeur)
        {
            $s .= $valeur->__toString();
        }
        $s .= "</form>\n";
        return $s;
    }

    public function add(Champ $champs)
    {
        $this->champs[] = $champs;
    }

    function hydrate(array $donnees)
    {
        foreach ($this->champs as $champ)
        {
            $champ->setValue($donnees[$champ->getName()]);
        }
    }

    function __toStringResultat()
    {
        $form = '';
        foreach($this->champs as $element){
            $form .= $element->getName() . ' => ' . $element->getValue() . '<br>';
        }
        return $form;
    }
}
