<?php

declare(strict_types = 1);

class Champ
{
    private $name;
    private $type;
    private $label;
    private $value;

    function __construct(string $label, string $name, string $type, string $value="")
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        $s = "";
        $s .= "<label for=\"".$this->name."\">".$this->label."</label>\n";
        $s .= "<input type=\"".$this->type . "\" name=\"".$this->name . "\" value=\"".$this->value . "\" /><br/>\n";
        return $s;
    }
}
