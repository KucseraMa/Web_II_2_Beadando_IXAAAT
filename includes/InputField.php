<?php

class InputField
{
    private $text;
    private $name;
    private $type;
    private $id;
    private $value;
    private $placeholder;
    private $dclass;//div
    private $iclass;//input


    public function __construct($text, $name, $type = "text")
    {
        $this->text = $text;
        $this->name = $name;
        $this->type = $type;
        $this->id = $name;
        $this->value = null;
        $this->placeholder = null;
        $this->dclass=null;
        $this->iclass=null;


    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function setDclass($dclass)
    {
        $this->dclass = $dclass;
        return $this;
    }


    public function setIclass($iclass)
    {
        $this->iclass = $iclass;
        return $this;
    }


    public function asHTML()
    {
        $html = '<div ';
        if ($this->dclass) {
            $html .= (' class="' . $this->dclass . '"');
        }else { $html .= ('class="form-floating mb-4"');}
        $html .='>';
        $html .= $this->createField();
        $html .= $this->createLabel();
        $html .= '</div>';

        return $html;
    }

    protected function createLabel()
    {
        return '<label for="' . $this->id . '">' . $this->text . '</label>';
    }

    protected function createField()
    {
        $html = ('<input type="' . $this->type . '" name="' . $this->name . '" id="' . $this->id . '"');
        if ($this->value !== null) {
            $html .= ('value="' . $this->value . '"');
        }
        if ($this->placeholder) {
            $html .= ('placeholder="' . $this->placeholder . '"');
        }
        if ($this->iclass) {
            $html .= ('class="' . $this->iclass . '"');
        }else{
            $html .= ('class="form-control"');
        }
        $html .= '>';

        return $html;
    }


}