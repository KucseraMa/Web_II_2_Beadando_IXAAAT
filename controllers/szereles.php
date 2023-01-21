<?php

class Szereles_Controller
{

    public $baseName = 'szereles';
    public function main(array $vars)
    {
        $view = new View_Loader($this->baseName."_main");
    }
}

