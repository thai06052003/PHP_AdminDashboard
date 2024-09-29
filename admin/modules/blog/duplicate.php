<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa blog */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $blogId = $body['id'];
    $blogDetail = firstRaw("SELECT * FROM `blog` WHERE id='$blogId'");
    if ( !empty( $blogDetail ) ) {
        // loại bỏ thời gian tạo (create_at) và thời gian cập nhật (update_at), id
        $blogDetail['create_at'] = date('Y-m-d H:i:s');

        unset($blogDetail['update_at']);
        unset($blogDetail['id']);

        $duplicate = $blogDetail['duplicate'];
        $duplicate++;
        $blogDetail['duplicate'] = 0;

        $title = $blogDetail['title'].' ('.$duplicate.')';
        $blogDetail['title'] = $title;

        $insertStatus = insert('blog', $blogDetail);
        if ($insertStatus) { 
            setFlashData('msg', 'Nhân bản blog thành công');
            setFlashData('msg_type', 'success');
            update('blog', ['duplicate' => $duplicate], "id=$blogId");
        }
    }
    else {
        setFlashData('msg','blog không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=blog');