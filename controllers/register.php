<?php

require_once "includes/FormBuilder.php";

class Register_Controller
{

    public $baseName = 'register';
    public function main(array $vars)
    {

        $view = new View_Loader($this->baseName."_main");
    }
}

?>