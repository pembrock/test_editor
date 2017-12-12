<?php
/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 19:24
 */

require_once __DIR__ . '/../inc/config.inc.php';

use Editor\Admin\Pages;
use Editor\Common\Authorization;

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig->setLoader($loader);

$authorization = new Authorization();
$data = [];
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($authorization->doAuth($email, $password)) {
        header('location: /admin/');
    } else {
        $data['error'] = 'Ошибка авторизации';
    }
}

if ($authorization->checkAuth()) {

    $pages = new Pages();

    if (isset($_POST['save'])) {
        //TODO: add fields checking
        $fields = [
            'id' => $_POST['id'],
            'title' => $_POST['title'],
            'header' => $_POST['header'],
            'content' => $_POST['content'],
            'additional_content' => $_POST['additional_content']
        ];

        $pages->update($fields);
        if ($_POST['id'] == 0) {
            header('location: /admin/');
        }
    }


    if (isset($_GET['view']) && $_GET['view'] == "pages" && isset($_GET['act'])) {
        $act = $_GET['act'];
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        switch ($act) {
            case "edit":
                $template = $twig->load('edit_page.twig');
                if ($id > 0) {
                    $data['page'] = $pages->getPage($id);
                }
                break;
            case "del":
                $pages->delete($id);
                header('location: /admin/');
                break;
        }
    } else {
        if (isset($_GET['s']) && !empty($_GET['s'])) {
            $data['pages'] = $pages->searchPage($_GET['s']);
        } else {
            $data['pages'] = $pages->pagesList();
        }
        $template = $twig->load('main.twig');
    }
} else {
    $template = $twig->load('login.twig');
}
echo $template->render(array('data' => $data));