<?php
if (!defined("_INCODE")) die('Access Deined...');

$data = [
	'pageTitle' => 'Trang chủ',
];
layout('header', 'client', $data);
require_once 'content/slide.php';
require_once 'content/about.php';
require_once 'content/service.php';
require_once 'content/facts.php';
require_once 'content/portfolios.php';
require_once 'content/cta.php';
require_once 'content/blog.php';
require_once 'content/partner.php';
?>

<?php
layout('footer', 'client');
