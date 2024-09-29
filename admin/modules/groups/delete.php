<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa người dùng */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $groupId = $body['id'];
    $groupDetail = getRaw("SELECT id FROM `groups` WHERE id='$groupId'");
    if ( !empty( $groupDetail ) ) {
        // kiểm tra xem trong nhóm còn người dùng ko
        $userNum = getRows("SELECT id FROM users WHERE group_id=$groupId");
        if ($userNum>0) {
            setFlashData('msg','Xóa nhóm người dùng không thành công. Trong nhóm vẫn còn '.$userNum.' người dùng');
                setFlashData('msg_type','danger');
        }
        else {
            // thực hiện xóa
            $condition ="id=$groupId";
            $deleteStatus = delete('groups', $condition);
            if ($deleteStatus) {
                setFlashData('msg','Xóa ngóm người dùng thành công');
                setFlashData('msg_type','success');
            }
            else {
                setFlashData('msg','Xóa nhóm người dùng không thành công. Vui lòng thử lại sau');
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
redirect('admin?module=groups');