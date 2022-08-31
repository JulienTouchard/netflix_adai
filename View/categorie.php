<?php
session_start();
if( $_SERVER['PHP_SELF'] === '/POO/netflix/index.php'){
    $pref = "./";
} else {$pref = '../';}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getController("FilmController"));
///////////////////////////////////
$activePrev = false;
$activePage = false;
$nbPage = FilmController::getNbPage($_GET['genre']);
if(isset($_GET['currentPage']) && !empty($_GET['currentPage'])){
    $currentPage = strip_tags($_GET['currentPage']);
    if (!is_numeric($currentPage)){
        $tmpCurrentPage = explode(",", $currentPage);
        if($tmpCurrentPage[0] === "next"){
            $currentPage = intval($tmpCurrentPage[1])+1;
        } else {
            if($tmpCurrentPage[1] == 2){
               $activePrev = true; 
            } else {
               $currentPage = intval($tmpCurrentPage[1])-1; 
            }
        }
    }
} else {
    $currentPage = 1;
    $activePrev = true;
}
////////////////////////////////////////////
$films = FilmController::getFilmsByGenre($_GET['genre'],$currentPage);
$films = json_encode($films);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $routeController->getAssets() ?>css/card.css">
    <script>
        const films = <?= $films ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.18.13/babel.min.js" integrity="sha512-PRl9KbPVEMeO1HV3BU5hcxpipzo2EVLe+tvWfLJf0A7PnKCfShArjZ2iXVAVo8ffpBSfRO0K58TYuquQvVSeVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= $routeController->getAssets() ?>js/card.js" type="text/babel" defer></script>
</head>

<body>
    <header>
        <?php include_once($routeController->getRoute("menu")); ?>
    </header>
    <main>
        <section id="displayFilms">
            <h2><?= $_GET['genre'] ?></h2>
            <div id="cardsFrame"></div>
            <div>
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link <?= $activePrev ? "disabled" : "" ?>" href="
                        <?= $routeController->getRoute("categorie")."?genre=".$_GET['genre']."&currentPage=prev,".$currentPage?>
                        ">&laquo;</a>
                    </li>
                    <?php for($i=1;$i<$nbPage+1;$i++) : ?>
                    <li class="page-item active">
                        <a class="page-link " href="
                        <?= $routeController->getRoute("categorie")."?genre=".$_GET['genre']."&currentPage=$i"?>
                        "><?=$i?></a>
                    </li>
                    <?php endfor ?>
                    <li class="page-item ">
                        <a class="page-link" href="
                        <?= $routeController->getRoute("categorie")."?genre=".$_GET['genre']."&currentPage=next,".$currentPage?>
                        ">&raquo;</a>
                    </li>
                </ul>
            </div>
        </section>
    </main>



</body>

</html>