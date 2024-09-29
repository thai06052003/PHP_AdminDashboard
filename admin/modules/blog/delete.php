<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa blog */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $blogId = $body['id'];
    $blogDetail = getRaw("SELECT id FROM `blog` WHERE id='$blogId'");
    if ( !empty( $blogDetail ) ) {
        // thực hiện xóa
        $condition ="id=$blogId";
        $deleteStatus = delete('blog', $condition);
        if ($deleteStatus) {
            setFlashData('msg','Xóa ngóm blog thành công');
            setFlashData('msg_type','success');
        }
        else {
            setFlashData('msg','Xóa blog không thành công. Vui lòng thử lại sau');
            setFlashData('msg_type','danger');
        }
    }
    else {
        setFlashData('msg','Blog không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=blog');