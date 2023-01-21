<?php

class Pdfgen_Controller{
    public $baseName = 'pdfgen';
    public function main(array $vars)
    {
        var_dump($_POST);
        $v  = new Pdfgen_Model();
        $v->gen_munkalap($_POST);

    }
}
