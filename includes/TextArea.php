<?php
// <textarea id="w3review" name="w3review" rows="4" cols="50">

class TextArea extends InputField{

    private $cols;
    private $rows;
    private $class;
    private $place;



    public function __construct($text,$name,$cols="", $rows="")
    {
        parent::__construct($text,$name,"");
        $this->cols = $cols;
        $this->rows = $rows;
        $this->class = null;
        $this->place=null;
    }

    public function setCols($cols)
    {
        $this->cols = $cols;
        return $this;
    }
    public function setRows($rows)
    {
        $this->rows = $rows;
        return $this;
    }

    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }



    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    protected function createField()
    {
    $html = '<textarea ';
        if ($this->class) {
            $html .= ('class="' . $this->class . '"');
        }
        if ($this->rows) {
            $html .= ('rows="' . $this->class . '"');
        }
        if ($this->cols) {
            $html .= ('cols="' . $this->class . '"');
        }
        if ($this->place) {
            $html .= ('placeholder="' . $this->place . '"');
        }
    $html .='name="'.$this->getName().'"id="'.$this->getId().'" >';
        $html.='</textarea>';
        return $html;
    }

}