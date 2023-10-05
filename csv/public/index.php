<?php
define("DIR_SRC", dirname(__FILE__) . '/../src/');
require_once '../vendor/autoload.php';
require_once DIR_SRC . 'inc/functions.php';
$loader = new \Twig\Loader\FilesystemLoader(DIR_SRC . 'templates');
$twig = new \Twig\Environment($loader);
require_once DIR_SRC . 'inc/routeur.php';
$router = new Route();

$router->addRoute('GET', '/', function () use ($twig) {
    echo $twig->render('home.html.twig');
});

$router->addRoute('POST', '/loadcsv', function () use ($twig) {
    require(DIR_SRC . "controller/loadcsv.php");
});

$router->addRoute('POST', '/filtre', function () use ($twig) {
    require(DIR_SRC . "controller/filtre.php");
});

$router->addRoute('POST', '/sendmail', function () use ($twig) {
    require(DIR_SRC . "controller/sendmail.php");
});

$router->run();
?>