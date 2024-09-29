<?php
session_start();
ob_start();
require_once("../config.php");
// Import phpmailer lib
require_once '../includes/phpmailer/PHPMailer.php';
require_once '../includes/phpmailer/SMTP.php';
require_once '../includes/phpmailer/Exception.php';

require_once '../includes/functions.php';
require_once '../includes/permalink.php';
require_once '../includes/connect.php';
require_once '../includes/database.php';
require_once '../includes/session.php';
require_once '../includes/permission.php';

ini_set('display_errors',0);
error_reporting(0);

$module = _MODULE_DEFAULT_ADMIN;
$action = _ACTION_DEFAULT;

set_exception_handler("setExceptionError");
set_error_handler("setErrorHandler");
loadExceptionError();
if (!empty($_GET['module']) && is_string(trim($_GET['module']))) {
    $module = trim($_GET['module']);
}

if (!empty($_GET['action']) && is_string(trim($_GET['action']))) {
    $action = trim($_GET['action']);
}

$path = './modules/'.$module.'/'.$action.'.php';

if (file_exists($path)) {
    require_once($path);
}
else {
    require_once('./modules/errors/404.php');
}
