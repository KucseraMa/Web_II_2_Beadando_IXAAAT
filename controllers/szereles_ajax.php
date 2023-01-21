<?php
include "./models/szereles_model.php";
       // var_dump($_POST);
       if(isset($_POST['ajax'])){
            switch ($_POST['ajax']){
                case 'tabla' :
                    $szerelesModel = new Szereles_Model();
                    $szerelesModel->get_data();
                break;
                case 'varos' :
                    $szerelesModel = new Szereles_Model();
                    $szerelesModel->get_varos();
                    break;
                case 'utca' :
                    $szerelesModel = new Szereles_Model();
                    $szerelesModel->get_utca($_POST);
                    break;
                case 'javdatum' :
                    $szerelesModel = new Szereles_Model();
                    $szerelesModel->get_javdatum($_POST);
                    break;
                case 'szurt' :
                    $szerelesModel = new Szereles_Model();
                    $szerelesModel->get_szurt($_POST);
                    break;
                case 'selectvaros' :
                    $szerelesModel = new Szereles_Model();
                    $szerelesModel->get_selectvaros($_POST);
                    break;
            }
     }