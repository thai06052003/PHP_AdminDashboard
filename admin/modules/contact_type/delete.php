<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa contact */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $contactTypeId = $body['id'];
    $contactTypeDetail = getRaw("SELECT id FROM `contact_type` WHERE id='$contactTypeId'");
    if ( !empty( $contactTypeDetail ) ) {
        // kiểm tra xem trong phòng ban còn contact ko
        $contactNum = getRows("SELECT id FROM contacts WHERE type_id =$contactTypeId");
        if ($contactNum>0) {
            setFlashData('msg','Xóa phòng ban contact không thành công. Trong phòng ban vẫn còn '.$contactNum.' contact');
                setFlashData('msg_type','danger');
        }
        else {
            // thực hiện xóa
            $condition ="id=$contactTypeId";
            $deleteStatus = delete('contact_type', $condition);
            if ($deleteStatus) {
                setFlashData('msg','Xóa phòng ban contact thành công');
                setFlashData('msg_type','success');
            }
            else {
                setFlashData('msg','Xóa phòng ban contact không thành công. Vui lòng thử lại sau');
                setFlashData('msg_type','danger');
            }
        }

        
    }
    else {
        setFlashData('msg','Nhóm không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=contact_type');