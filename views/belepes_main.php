<?php
require_once "includes/FormBuilder.php";

echo '<div class="container login-container">';
echo '<div class="login-form-1">';
echo '<h3>Belépés</h3>';
$form = (new FormBuilder( SITE_ROOT."beleptet", "post"))
->addInput((new InputField("Felhasználó név", "username"))
    ->setDclass("form-group form-floating mb-4")
    ->setPlaceholder("Felhasználó név")
    ->setIclass("form-control")
)
->addInput((new InputField("Jelszó", "pass", "password"))
    ->setDclass("form-group form-floating")
    ->setPlaceholder("Jelszó")
)
->setBtnText("Bejelentkezés")/*->onSubmit(function ($data) {
echo '<p>Submited</p>';
echo '<pre>';
var_dump($data);
echo '</pre>';

})*/;

echo $form->asHTML();
echo '<a type="button" href="'.SITE_ROOT.'register" class="btn btn-primary">Regisztráció</a>';

?>
<h2><br><?= (isset($viewData['uzenet']) ? $viewData['uzenet'] : "") ?><br></h2>
        </div>
</div>








