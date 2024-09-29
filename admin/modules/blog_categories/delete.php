<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa blog */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $categoryId = $body['id'];
    $categoryDetail = getRaw("SELECT id FROM `blog_categories` WHERE id='$categoryId'");
    if ( !empty( $categoryDetail ) ) {
        // kiểm tra xem trong danh mục còn blog ko
        $blogNum = getRows("SELECT id FROM blog WHERE category_id =$categoryId");
        if ($blogNum>0) {
            setFlashData('msg','Xóa danh mục blog không thành công. Trong danh mục vẫn còn '.$blogNum.' blog');
                setFlashData('msg_type','danger');
        }
        else {
            // thực hiện xóa
            $condition ="id=$categoryId";
            $deleteStatus = delete('blog_categories', $condition);
            if ($deleteStatus) {
                setFlashData('msg','Xóa danh mục blog thành công');
                setFlashData('msg_type','success');
            }
            else {
                setFlashData('msg','Xóa danh mục blog không thành công. Vui lòng thử lại sau');
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
redirect('admin?module=blog_categories');