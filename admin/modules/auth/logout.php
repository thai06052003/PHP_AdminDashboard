<?php
if ( ! defined("_INCODE") ) die('Access Deined...'); 
// file này chứa chức năng đăng xuất
print_r(islogin());
if (islogin()) {
    $token = getSession('loginToken');
    delete('login_token', "token='$token'");
    removeSession('loginToken');
    if (!empty($_SERVER['HTTP_REFERER'])) {
        redirect($_SERVER['HTTP_REFERER'], true);
    }
    else {
        redirect('admin?module=auth&action=login');
    }
}