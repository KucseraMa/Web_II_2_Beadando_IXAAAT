
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/svg" sizes="16x16" rel="icon" href="https://www.svgrepo.com/show/102741/plumber.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src = "./js/szereles.js"></script>

    <title>1-02-Vízvezeték-szerelők</title>
</head>
    <body>
    <nav class="navbar navbar-expand-lg navbar" id="navmenu" style="background-color:#bbb;">
        <div class="container-fluid">
                <img src="https://www.svgrepo.com/show/102741/plumber.svg" width="35" height="35" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">

                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php  echo Menu::getMenu($viewData['selectedItems'] ); ?>


            </div>
            <div class="d-flex">
                <?php
                if(isset($_SESSION['logedin']) && $_SESSION['logedin'] == 1) { ?><strong><?= $_SESSION['userlastname']." ".$_SESSION['userfirstname'] ?></strong><?php }
                else {echo 'Vendég';}
                ?>
            </div>
        </div>

    </nav>


    <div class="container ">
        <div class="row">


            <div class="col-sm-12 text-center">
                <?php if($viewData['render']) include($viewData['render']); ?>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer container-fluid fixed-bottom text-center text-lg-start"style="background-color:#bbb;">
        <div class="text-center p-1">
            © 2023 Copyright Vízvezeték szerelő KFT.

        </div>

    </footer>


    </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


</html>
