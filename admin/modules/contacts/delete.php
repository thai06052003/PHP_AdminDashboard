<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa liên hệ */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $contactId = $body['id'];
    $contactDetail = getRaw("SELECT id FROM `contacts` WHERE id='$contactId'");
    if ( !empty( $contactDetail ) ) {
        // thực hiện xóa
        $condition ="id=$contactId";
        $deleteStatus = delete('contacts', $condition);
        if ($deleteStatus) {
            setFlashData('msg','Xóa ngóm liên hệ thành công');
            setFlashData('msg_type','success');
        }
        else {
            setFlashData('msg','Xóa liên hệ không thành công. Vui lòng thử lại sau');
            setFlashData('msg_type','danger');
        }
    }
    else {
        setFlashData('msg','Liên hệ không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=contacts');