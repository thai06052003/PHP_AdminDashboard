<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa dự án */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $portfoliosId = $body['id'];
    $portfoliosDetail = getRaw("SELECT id FROM `portfolios` WHERE id='$portfoliosId'");
    if ( !empty( $portfoliosDetail ) ) {
        // Xử lý xóa thư viện ảnh
        delete('portfolio_images', 'portfolio_id='.$body['id']);
        // thực hiện xóa
        $condition ="id=$portfoliosId";
        $deleteStatus = delete('portfolios', $condition);
        if ($deleteStatus) {

            

            setFlashData('msg','Xóa ngóm dự án thành công');
            setFlashData('msg_type','success');
        }
        else {
            setFlashData('msg','Xóa dự án không thành công. Vui lòng thử lại sau');
            setFlashData('msg_type','danger');
        }
    }
    else {
        setFlashData('msg','Dự án không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=portfolios');