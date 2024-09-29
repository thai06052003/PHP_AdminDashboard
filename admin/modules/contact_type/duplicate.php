<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để nhân bản phòng ban */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $contatTypeId = $body['id'];
    $contatTypeDetail = firstRaw("SELECT * FROM `contact_type` WHERE id='$contatTypeId'");
    if ( !empty( $contatTypeDetail ) ) {
        // loại bỏ thời gian tạo (create_at) và thời gian cập nhật (update_at), id
        $contatTypeDetail['create_at'] = date('Y-m-d H:i:s');

        unset($contatTypeDetail['update_at']);
        unset($contatTypeDetail['id']);

        $duplicate = $contatTypeDetail['duplicate'];
        $duplicate++;
        $contatTypeDetail['duplicate'] = 0;

        $name = $contatTypeDetail['name'].' ('.$duplicate.')';
        $contatTypeDetail['name'] = $name;

        $insertStatus = insert('contact_type', $contatTypeDetail);
        if ($insertStatus) { 
            setFlashData('msg', 'Nhân bản phòng ban thành công');
            setFlashData('msg_type', 'success');
            update('contact_type', ['duplicate' => $duplicate], "id=$contatTypeId");
        }
    }
    else {
        setFlashData('msg','phòng ban không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=contact_type');