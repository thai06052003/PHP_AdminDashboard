<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
// require_once './index.html';
try {
    if (class_exists('PDO') ) {
        $dns = _DRIVER.':dbname='._DB.'; host='._HOST;
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,    // đẩy lỗi ngoại lệ truy vấn
        ];
        $conn = new PDO( $dns, _USER, _PASS ,$options );
    }
} catch (PDOException $e) {
    /* echo '<div style="color: red; border: 1px solid red; padding: 5px 15px">';
    echo $e->getMessage() .'<br>';
    echo 'File: '.$e->getFile() .'<br>';
    echo 'Line: '.$e->getLine() .'<br>';
    echo '</div>'; */

    require_once './modules/errors/database.php';   // Import error
    die();
}