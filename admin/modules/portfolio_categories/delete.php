<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa dự án */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $categoryId = $body['id'];
    $categoryDetail = getRaw("SELECT id FROM `portfolio_categories` WHERE id='$categoryId'");
    if ( !empty( $categoryDetail ) ) {
        // kiểm tra xem trong danh mục còn dự án ko
        $portfolioNum = getRows("SELECT id FROM portfolios WHERE portfolio_category_id =$categoryId");
        if ($portfolioNum>0) {
            setFlashData('msg','Xóa danh mục dự án không thành công. Trong danh mục vẫn còn '.$portfolioNum.' dự án');
                setFlashData('msg_type','danger');
        }
        else {
            // thực hiện xóa
            $condition ="id=$categoryId";
            $deleteStatus = delete('portfolio_categories', $condition);
            if ($deleteStatus) {
                setFlashData('msg','Xóa danh mục dự án thành công');
                setFlashData('msg_type','success');
            }
            else {
                setFlashData('msg','Xóa danh mục dự án không thành công. Vui lòng thử lại sau');
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
redirect('admin?module=portfolio_categories');