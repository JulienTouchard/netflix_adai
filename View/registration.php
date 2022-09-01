<?php
session_start();
if( $_SERVER['PHP_SELF'] === '/POO/netflix/index.php'){
    $pref = "./";
} else {$pref = '../';}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getController("UserController"));
$userController = new UserController();
$register = $userController->register($_POST);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
    <title>registration form</title>
</head>

<body>
<header>
        <?php
        include_once($routeController->getInc("menu"));
        ?>
    </header>
    <section class="formSignup">
        <form action="" method="post">
            <div>
                <input type="text" name="login" value="<?= 
                 isset($userController->post['login']) ? $userController->post['login'] : ""  
                ?>" placeholder="Login">
                <?= isset($userController->errors['login']) ? "<span>".$userController->errors['login']."</span>" : "" ?>
            </div>
            <div>
                <input type="email" name="email" value="<?= 
                isset($userController->post['email']) ? $userController->post['email'] : "" 
                ?>" placeholder="Email">
                <?= isset($userController->errors['email']) ? "<span>".$userController->errors['email']."</span>" : "" ?>
            </div>
            <div>
                <input type="password" name="pwd" value="<?= 
                isset($userController->post['pwd']) ? $userController->post['pwd'] : "" 
                ?>" placeholder="Mot de Passe">
                <?= isset($userController->errors['pwd']) ? "<span>".$userController->errors['pwd']."</span>" : "" ?>
            </div>
            <div>
                <input type="text" name="confirmPwd" value="<?= 
                isset($userController->post['confirmPwd']) ? $userController->post['confirmPwd'] : ""
                ?>" placeholder="Confirmez votre mot">
                <?= isset($userController->errors['confirmPwd']) ? "<span>".$userController->errors['confirmPwd']."</span>" : "" ?>
            </div>
            <div>
                <input type="submit" name="submited" value="Envoyer">
            </div>
        </form>
    </section>
</body>

</html>