<?php 
session_start();
if( $_SERVER['PHP_SELF'] === '/POO/netflix/index.php'){
    $pref = "./";
} else {$pref = '../';}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getController("UserController"));
$userController = new UserController;
$login = $userController->login($_POST,$_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header>
        <?php
        include_once($routeController->getRoute("menu"));
        ?>
    </header>
    <main>

        <form action="" method="post">
            <div><input type="text" name="login" placeholder="Entrez votre login ou email"><span></span></div>
            <div><input type="password" name="pwd" placeholder="Entrez votre mot de passe"><span></span></div>
            <div><input type="submit" value="Envoyer" name="submited"><span></span></div>
        </form>
    </main>
</body>
</html>