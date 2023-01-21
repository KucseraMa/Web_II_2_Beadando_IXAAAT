<?php

class Registration_Controller
{

    public $baseName = 'registed';
    public function main(array $vars)
    {
        $registrationModel = new Registration_Model();
        $retData = $registrationModel->set_data($vars);
        if($retData['eredmeny'] == "ERROR")
            $this->baseName = "register";


        $view = new View_Loader($this->baseName.'_main');
        foreach($retData as $name => $value)
            $view->assign($name, $value);
    }
}

