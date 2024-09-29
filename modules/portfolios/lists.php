<?php
if (!defined("_INCODE")) die('Access Deined...');

$data = [
    'pageTitle' => getOption('portfolio-title'),
];

layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);

$isPortfolioPage = true;

require_once _WEB_PATH_ROOT.'/modules/home/content/portfolios.php';
?>

<?php
require_once _WEB_PATH_ROOT.'/modules/home/content/partner.php';
layout('footer', 'client');
