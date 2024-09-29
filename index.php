<?php

session_start();
ob_start();
require_once("./config.php");
require_once("./routes.php");

// Import phpmailer lib
require_once './includes/phpmailer/PHPMailer.php';
require_once './includes/phpmailer/SMTP.php';
require_once './includes/phpmailer/Exception.php';

require_once './includes/functions.php';
require_once './includes/permalink.php';
require_once './includes/connect.php';
require_once './includes/database.php';
require_once './includes/session.php';

ini_set('display_errors', 0);
error_reporting(0);

$module = _MODULE_DEFAULT;
$action = _ACTION_DEFAULT;

set_exception_handler("setExceptionError");
set_error_handler("setErrorHandler");
loadExceptionError();

// xử lý require url
$currentUrl = null;
if (empty($_GET['module'])) {
    $currentUrl = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
} else {
    loadError();
}
if ($currentUrl != '/') {
    $currentUrl = trim($currentUrl, '/');
}

$targerUrl = null;

if (!empty($route)) {
    foreach ($route as $key => $item) {
        if (preg_match('~^' . $key . '$~i', $currentUrl)) {
            $targerUrl = preg_replace('~^' . $key . '$~i', $item, $currentUrl);
            break;
        }
    }
}

if (!empty($targerUrl)) {
    $targetUrlArr = parse_url($targerUrl);
    if (!empty($targetUrlArr['query'])) {
        $targetUrlQuery = $targetUrlArr['query'];

        $targetUrlQueryArr = array_filter(explode('&', $targetUrlQuery));

        if (!empty($targetUrlQueryArr)) {
            foreach ($targetUrlQueryArr as $item) {
                $itemArr = array_filter(explode('=', $item));
                $_GET[$itemArr[0]] = $itemArr[1];
            }
        }
    }
}
/* echo '<pre>';
print_r($_GET);
echo '</pre>';

die(); */

if (!empty($_GET['module']) && is_string(trim($_GET['module']))) {
    $module = trim($_GET['module']);
}

if (!empty($_GET['action']) && is_string(trim($_GET['action']))) {
    $action = trim($_GET['action']);
}
//echo $module.'<br>'.$action;

$path = './modules/' . $module . '/' . $action . '.php';
//echo $path;

if (file_exists($path)) {
    require_once($path);
} else {
    require_once('./modules/errors/404.php');
}
