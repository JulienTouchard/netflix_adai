<?php
session_start();
if ($_SERVER['PHP_SELF'] === '/POO/netflix/index.php') {
    $pref = "./";
} else {
    $pref = '../';
}
require_once($pref . "Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getController("FilmController"));
$nbPage = FilmController::getNbPage($_GET['genre']);
/////////////////////////////////// pagination ///////////////////////////////
$activePrev = false;
$activePage = 1;
$activeNext = false;
$currentPage = 1;
if (isset($_GET['currentPage']) && !empty($_GET['currentPage'])) {
    //pour exporter ce code dans un controller j'ai besoin des parametres suivants :
    // $_GET['currentPage'],$nbPage
    // les retours de ma methode : $activePrev,$activePage,$activeNext,$currentPage 
    $responsePageManager = FilmController::pageManager($_GET['currentPage'], $nbPage, $activePrev, $activePage, $activeNext);
    $activePrev = $responsePageManager[0];
    $activePage = $responsePageManager[1];
    $activeNext = $responsePageManager[2];
    $currentPage = $responsePageManager[3];
} else {
    $activePrev = true;
}
//////////////////////////////////////////////////////////////////////////////
$films = FilmController::getFilmsByGenre($_GET['genre'], $currentPage);
$films = json_encode($films);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorie : <?= $_GET['genre'] ?></title>
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
        <?php include_once($routeController->getInc("menu")); ?>
    </header>
    <main>
        <section id="displayFilms">
            <h2><?= $_GET['genre'] ?></h2>
            <?php include($routeController->getInc("pagination")); ?>
            <div id="cardsFrame"></div>
            <?php include($routeController->getInc("pagination")); ?>
        </section>
    </main>
</body>

</html>