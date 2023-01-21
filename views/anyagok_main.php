<?php
require_once "includes/FormBuilder.php";
$url = SITE_ROOT."/models/anyagok_model.php";
$result = "";
if(isset($_POST['id']))
{
  // Felesleges szóközök eldobása
  $_POST['id'] = trim($_POST['id']);
  $_POST['anyag'] = trim($_POST['anyag']);
  $_POST['db'] = trim($_POST['db']);
  $_POST['elerheto'] = trim($_POST['elerheto']);
  $_POST['ar'] = trim($_POST['ar']);

  // Ha nincs id és megadtak minden adatot (családi név, utónév, bejelentkezési név, jelszó), akkor beszúrás
  if($_POST['id'] == "" && $_POST['anyag'] != "" && $_POST['db'] != "" && $_POST['elerheto'] != "" && $_POST['ar'] != "")
  {
      $data = Array("anyag" => $_POST["anyag"], "db" => $_POST["db"], "elerheto" => $_POST["elerheto"], "ar" => $_POST["ar"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }




  // Ha nincs id de nem adtak meg minden adatot
  elseif($_POST['id'] == "")
  {
    $result = "Hiba: Hiányos adatok!";
  }

  // Ha van id, amely >= 1, és megadták legalább az egyik adatot (családi név, utónév, bejelentkezési név, jelszó), akkor módosítás
  elseif($_POST['id'] >= 1 && ($_POST['anyag'] != "" || $_POST['db'] != "" || $_POST['elerheto'] != "" || $_POST['ar'] != ""))
  {
      $data = Array("id" => $_POST["id"], "anyag" => $_POST["anyag"], "db" => $_POST["db"], "elerheto" => $_POST["elerheto"], "ar" => $_POST["ar"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }

  // Ha van id, amely >=1, de nem adtak meg legalább az egyik adatot
  elseif($_POST['id'] >= 1)
  {
      $data = Array("id" => $_POST["id"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }

  // Ha van id, de rossz az id, akkor a hiba kiírása
  else
  {
    echo "Hiba: Rossz azonosító (Id): ".$_POST['id']."<br>";
  }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tabla = curl_exec($ch);
curl_close($ch);

?>


    <h1>Anyagok</h1>

        <div class="row">
            <div class="col-lg-6">
                <div class="container login-container">
                    <div class="login-form-1">
                        <h2>Módosítás / Beszúrás</h2>
                        <?php
                        $form = (new FormBuilder( "", "post"))
                            ->addInput((new InputField("ID", "id"))
                                ->setDclass("form-group form-floating mb-4")
                                ->setPlaceholder("id")
                                ->setIclass("form-control")
                            )
                            ->addInput((new InputField("Anyag", "anyag"))
                                ->setDclass("form-group form-floating mb-4")
                                ->setPlaceholder("Anyag")
                                ->setIclass("form-control")
                            )
                            ->addInput((new InputField("Db szám", "db"))
                                ->setDclass("form-group form-floating mb-4")
                                ->setPlaceholder("Db")
                                ->setIclass("form-control")
                            )
                            ->addInput((new InputField("Elérhető", "elerheto"))
                                ->setDclass("form-group form-floating mb-4")
                                ->setPlaceholder("Elérhető")
                                ->setIclass("form-control")
                            )
                            ->addInput((new InputField("Ár", "ar"))
                                ->setDclass("form-group form-floating mb-4")
                                ->setPlaceholder("Ár")
                                ->setIclass("form-control")
                            )

                            ->setBtnText("Küldés");
                        echo $form->asHTML();
                        $result;
                        ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6" style="margin-top: 15px">
                <div class="table-responsive">
                    <?= $tabla ?>
                </div>
                  <canvas id="myChart"></canvas>
            </div>
        </div>






<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Hosszú cső', 'Rövid cső', 'Görbe cső', 'Cső kulcs', 'Bakancs',],
      datasets: [{
        label: '# Anyag darab',
        data: [10, 10, 31, 3, 20],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
