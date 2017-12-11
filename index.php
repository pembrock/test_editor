<?php
/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 19:43
 */

require_once __DIR__ . '/inc/config.inc.php';

$template = $twig->load('index.twig');
echo $template->render();