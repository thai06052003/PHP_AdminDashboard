<?php
if (!defined("_INCODE")) die('Access Deined...');
/* file này dùng để xóa blog */
$body = getBody();
if (!empty($body['id'])) {
    $commentId = $body['id'];
    $commentDetail = getRaw("SELECT id FROM comment WHERE id='$commentId'");
    if (!empty($commentDetail)) {
        $allowStatus = [0, 1];
        if (isset($body['status']) && in_array($body['status'], $allowStatus)) {
            $status = $body['status'];
            $msg = $status==0 ? 'Duyệt' : 'Gỡ trạng thái duyệt';

            // thực hiện duyệt
            $condition = "id=$commentId";
            $statusUpdate = update('comment',['status' => $status], $condition);

            if ($statusUpdate) {
                setFlashData('msg', $msg.' bình luận thành công');
                setFlashData('msg_type', 'success');
            } else {
                setFlashData('msg', 'Duyệt bình luận không thành công. Vui lòng thử lại sau');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Liên kết không tồn tại');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Bình luận không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}
redirect('admin?module=comments');
?>
<h1>status</h1>