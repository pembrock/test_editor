<?php
/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 19:24
 */

require_once __DIR__ . '/../inc/config.inc.php';

use Editor\Common\Authorization;

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig->setLoader($loader);



$template = $twig->load('login.twig');
echo $template->render();