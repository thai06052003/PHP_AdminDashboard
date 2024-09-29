<?php
/* file này chứa các thông số cấu hình */
date_default_timezone_set("Asia/Ho_Chi_Minh");

// thiết lập hằng số cho client
const _MODULE_DEFAULT = "home";
const _ACTION_DEFAULT = "lists";

// thiết lập hằng số cho admin
const _MODULE_DEFAULT_ADMIN = "dashboard";

const _INCODE = true;   // ngăn chặn hành vi truy cập trực tiếp vào file'

// thiết lập host
define("_WEB_HOST_ROOT", 'http://'.$_SERVER['HTTP_HOST'].'/codephp/MD6/radix');  // đia chỉ trang chủ
define("_WEB_HOST_TEMPLATE", _WEB_HOST_ROOT.'/templates/client');  // đia chỉ trang template
define('_WEB_HOST_ROOT_ADMIN', _WEB_HOST_ROOT.'/admin');
define('_WEB_HOST_ADMIN_TEMPLATE', _WEB_HOST_ROOT.'/templates/admin');

// thiết lập path
define('_WEB_PATH_ROOT', __DIR__);
define('_WEB_PATH_TEMPLATE', _WEB_PATH_ROOT.'/templates');

// Thiết lập kết nối database
const _HOST = 'localhost';
const _USER = 'root';
const _PASS = '';
const _DB = 'csdl_radix';
const _DRIVER = 'mysql';

// Thiết lập Debug
const _DEBUG = true;


// thiết lập số lượng bản ghi được hiển thị trên 1 trang admin
const _PER_PAGE = 5;
