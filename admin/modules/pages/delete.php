<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa trang */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $pageId = $body['id'];
    $pageDetail = getRaw("SELECT id FROM `pages` WHERE id='$pageId'");
    if ( !empty( $pageDetail ) ) {
        // thực hiện xóa
        $condition ="id=$pageId";
        $deleteStatus = delete('pages', $condition);
        if ($deleteStatus) {
            setFlashData('msg','Xóa ngóm trang thành công');
            setFlashData('msg_type','success');
        }
        else {
            setFlashData('msg','Xóa trang không thành công. Vui lòng thử lại sau');
            setFlashData('msg_type','danger');
        }
    }
    else {
        setFlashData('msg','trang không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=pages');