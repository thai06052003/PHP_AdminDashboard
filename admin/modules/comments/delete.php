<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa blog */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $commentId = $body['id'];
    $commentDetail = getRaw("SELECT id FROM comment WHERE id='$commentId'");
    if ( !empty( $commentDetail ) ) {

        // truy vấn lấy tất cả comment
        $commentData = getRaw("SELECT * FROM comment");

        
        $commentIdArr = getcommentReply($commentData, $commentId);
        $commentIdArr[] = $commentId;
        $commentIdStr = implode(',', $commentIdArr);

        // thực hiện xóa
        $condition ="id IN ($commentIdStr)";

        $deleteStatus = delete('comment', $condition);
        if ($deleteStatus) {
            setFlashData('msg','Xóa bình luận thành công');
            setFlashData('msg_type','success');
        }
        else {
            setFlashData('msg','Xóa bình luận không thành công. Vui lòng thử lại sau');
            setFlashData('msg_type','danger');
        }
    }
    else {
        setFlashData('msg','Bình luận không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=comments');