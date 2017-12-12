<?php
/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 11.12.17
 * Time: 22:19
 */
session_start();
require_once __DIR__ . "/../vendor/autoload.php";

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
    'debug' => true,
));
$twig->addExtension(new Twig_Extension_Debug());