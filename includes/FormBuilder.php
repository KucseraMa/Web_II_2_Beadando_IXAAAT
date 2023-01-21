<?php


require_once 'InputField.php';
require_once 'TextArea.php';

class FormBuilder
{
    private $action;
    private $method;
    private $id;
    private $btnText;
    private $fields;
    private $btnName;

    public function __construct($action = "", $method = "post", $id = "input")
    {
        $this->action = $action;
        $this->method = $method;
        $this->id = $id;
        $this->btnText = "Submit";
        $this->btnName = $id ;
        $this->fields = [];
    }

    public function setBtnText($btnText)
    {
        $this->btnText = $btnText;
        return $this;
    }


    public function addInput(InputField $field)
    {
        $name = $field->getName();
        $field->setId($this->id . "-" . $name);
        $this->fields [] = $field;
        return $this;
    }

    public function onSubmit($method)
    {
        if (strtolower($this->method) == "get") {
            $source = $_GET;
        } else {
            $source = $_POST;
        }
        if (isset($source[$this->btnName])) {
            unset($source[$this->btnName]);
            call_user_func($method, $source);
        }
        return $this;
    }


    public function asHTML()
    {
        $html='<div class="form-test">';
        $html .= '<form action="' . $this->action . '"method="' . $this->method . '"id="' . $this->id . '"class="">';

        foreach ($this->fields as $field) {
            $html .= $field->asHTML();
        }

        $html .= ('<button name="' . $this->btnName . '"class="btn btn-info ">' . $this->btnText . '</button>');
        $html .= '</form>';
        $html .="</div>";
        return $html;
    }

}