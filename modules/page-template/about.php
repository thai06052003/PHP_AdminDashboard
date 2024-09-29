<?php
if (!defined("_INCODE")) die('Access Deined...');

$data = [
    'pageTitle' => getOption('about-title'),
];

layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);

require_once _WEB_PATH_ROOT.'/modules/home/content/about.php';
require_once _WEB_PATH_ROOT.'/modules/home/content/partner.php';
?>

<?php
layout('footer', 'client');
