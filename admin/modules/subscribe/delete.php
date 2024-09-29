<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa trang */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $subscribeId = $body['id'];
    $subscrubeDetail = getRaw("SELECT id FROM subscribe WHERE id='$subscribeId'");
    if ( !empty( $subscrubeDetail ) ) {
        // thực hiện xóa
        $condition ="id=$subscribeId";
        $deleteStatus = delete('subscribe', $condition);
        if ($deleteStatus) {
            setFlashData('msg','Xóa đăng ký thành công');
            setFlashData('msg_type','success');
        }
        else {
            setFlashData('msg','Xóa đăng ký không thành công. Vui lòng thử lại sau');
            setFlashData('msg_type','danger');
        }
    }
    else {
        setFlashData('msg','Đăng ký không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=subscribe');