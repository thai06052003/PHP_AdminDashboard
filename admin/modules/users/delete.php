<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa người dùng */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $userId = $body['id'];
    $userDetail = getRaw("SELECT id FROM users WHERE id='$userId'");
    if ( !empty( $userDetail ) ) {
        // thực hiện xóa

        // 1. xóa login token
        $deleteToken = delete('login_token', "user_id='$userId'");
        if ( !empty( $deleteToken ) ) {
            $deleteUser = delete("users", "id='$userId'");
            if ( !empty( $deleteUser ) ) {
                setFlashData("msg","Xóa người dùng thành công");
                setFlashData("msg_type","success");
            }
            else {
                setFlashData("msg","Lỗi hệ thống! Vui lòng thử lại sau");
                setFlashData("msg_type","danger");
            }
        }
        else {
            setFlashData("msg","Lỗi hệ thống! Vui lòng thử lại sau");
            setFlashData("msg_type","danger");
        }
    }
    else {
        setFlashData('msg','Người dùng không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=users');