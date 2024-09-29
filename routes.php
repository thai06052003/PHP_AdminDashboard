<?php
// trang chủ
$route['/'] = 'index.php?module=home';
// trang blog
$route['blog/.+-(.+).html'] = 'index.php?module=blog&action=detail&id=$1';
// danh mục blog
$route['danh-muc/.+-(.+).html'] = 'index.php?module=blog&action=category&id=$1';
// Phân trang: danh mục blog
$route['danh-muc/.+-(.+)-page-(.+)'] = 'index.php?module=blog&action=category&id=$1&page=$2';
// dịch vụ
$route['dich-vu/.+-(.+).html'] = 'index.php?module=services&action=detail&id=$1';
// page
$route['thong-tin/.+-(.+).html'] = 'index.php?module=page&action=detail&id=$1';
// dự án
$route['du-an/.+-(.+).html'] = 'index.php?module=portfolios&action=detail&id=$1';
// giới thiệu
$route['gioi-thieu.html'] = 'index.php?module=page-template&action=about';
// đội ngũ
$route['doi-ngu.html'] = 'index.php?module=page-template&action=team';
// dịch vụ
$route['dich-vu.html'] = 'index.php?module=services';
// dự án
$route['du-an.html'] = 'index.php?module=portfolios';
// tin tức
$route['tin-tuc.html'] = 'index.php?module=blog';
// phân trang: tin tức (blog)
$route['tin-tuc-page-(.+).html'] = 'index.php?module=blog&page=$1';
// liên hệ
$route['lien-he.html'] = 'index.php?module=page-template&action=contacts';
// tìm kiếm
$route['tim-kiem.html'] = 'index.php?module=search';
// đăng ký nhận thông tin
$route['submit-subscribe.html'] = 'index.php?module=subscribe&action=submit';

