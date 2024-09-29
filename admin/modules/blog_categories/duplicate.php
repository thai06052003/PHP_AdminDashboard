<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để nhân bản danh mục */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $categoryId = $body['id'];
    $categoryDetail = firstRaw("SELECT * FROM `blog_categories` WHERE id='$categoryId'");
    if ( !empty( $categoryDetail ) ) {
        // loại bỏ thời gian tạo (create_at) và thời gian cập nhật (update_at), id
        $categoryDetail['create_at'] = date('Y-m-d H:i:s');

        unset($categoryDetail['update_at']);
        unset($categoryDetail['id']);

        $duplicate = $categoryDetail['duplicate'];
        $duplicate++;
        $categoryDetail['duplicate'] = 0;

        $name = $categoryDetail['name'].' ('.$duplicate.')';
        $categoryDetail['name'] = $name;

        $insertStatus = insert('blog_categories', $categoryDetail);
        if ($insertStatus) { 
            setFlashData('msg', 'Nhân bản danh mục thành công');
            setFlashData('msg_type', 'success');
            update('blog_categories', ['duplicate' => $duplicate], "id=$categoryId");
        }
    }
    else {
        setFlashData('msg','danh mục không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=blog_categories');