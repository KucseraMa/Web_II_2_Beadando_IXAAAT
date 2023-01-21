<?php
require_once "includes/FormBuilder.php";

echo '<div class="container login-container" style="text-align: center">';
echo '<div class="login-form-1">';
echo '<h3>Regisztráció</h3>';
        $form = (new FormBuilder(SITE_ROOT."registration", "post"))
            ->addInput((new InputField("Vezetéknév", "lastname"))
                ->setPlaceholder("Vezetéknév")
                ->setDclass("form-group form-floating mb-4")
                ->setIclass("form-control")
            )
            ->addInput((new InputField("Keresztnév", "firstname"))
                ->setPlaceholder("Keresztnév")
                ->setDclass("form-group form-floating mb-4")
                ->setIclass("form-control")
            )
            ->addInput((new InputField("Felhasználó név", "username"))
                ->setPlaceholder("Felhasználó név")
                ->setDclass("form-group form-floating mb-4")
                ->setIclass("form-control")
            )
            ->addInput((new InputField("Jelszó", "pass", "password"))
                ->setPlaceholder("Jelszó")
                ->setDclass("form-group form-floating mb-4")
                ->setIclass("form-control")
            )
            ->addInput((new InputField("Jelszó megerősítése", "pass2", "password"))
                ->setPlaceholder("Jelszó megerősítése")
                ->setDclass("form-group form-floating mb")
                ->setIclass("form-control")
            )
            ->setBtnText("Register");
        echo $form->asHTML();
        echo '<a type="button" href="'.SITE_ROOT.'belepes"  class="btn btn-primary">Login</a>';
?>
<h2><br><?= (isset($viewData['uzenet']) ? $viewData['uzenet'] : "") ?><br></h2>
</div>
</div>
