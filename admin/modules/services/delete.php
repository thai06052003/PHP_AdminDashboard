<!-- file này dùng để xóa dịch vụ -->
<?php
if ( ! defined("_INCODE") ) die('Access Deined...');

// kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if (!$checkPermission) {
    redirectPermission();
}

$body = getBody();
if (!empty( $body['id'] ) ) {
    $serviceId = $body['id'];
    $serviceDetail = getRaw("SELECT id FROM `services` WHERE id='$serviceId'");
    if ( !empty( $serviceDetail ) ) {
        // thực hiện xóa
        $condition ="id=$serviceId";
        $deleteStatus = delete('services', $condition);
        if ($deleteStatus) {
            setFlashData('msg','Xóa ngóm dịch vụ thành công');
            setFlashData('msg_type','success');
        }
        else {
            setFlashData('msg','Xóa dịch vụ không thành công. Vui lòng thử lại sau');
            setFlashData('msg_type','danger');
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