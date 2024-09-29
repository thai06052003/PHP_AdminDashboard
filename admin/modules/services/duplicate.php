<?php
/* file này dùng để xóa dịch vụ */
if ( ! defined("_INCODE") ) die('Access Deined...');

// kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if (!$checkPermission) {
    redirectPermission();
}

$body = getBody();
if (!empty( $body['id'] ) ) {
    $serviceId = $body['id'];
    $serviceDetail = firstRaw("SELECT * FROM `services` WHERE id='$serviceId'");
    if ( !empty( $serviceDetail ) ) {
        // loại bỏ thời gian tạo (create_at) và thời gian cập nhật (update_at), id
        $serviceDetail['create_at'] = date('Y-m-d H:i:s');

        unset($serviceDetail['update_at']);
        unset($serviceDetail['id']);

        $duplicate = $serviceDetail['duplicate'];
        $duplicate++;
        $categoryDetail['duplicate'] = 0;

        $name = $serviceDetail['name'].' ('.$duplicate.')';
        $serviceDetail['name'] = $name;

        $insertStatus = insert('services', $serviceDetail);
        if ($insertStatus) { 
            setFlashData('msg', 'Nhân bản dịch vụ thành công');
            setFlashData('msg_type', 'success');
            update('services', ['duplicate' => $duplicate], "id=$serviceId");
        }
    }
    else {
        setFlashData('msg','Dịch vụ không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=services');