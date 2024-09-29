<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật bình luận',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// lấy dữ liệu cũ của comment
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])) {
    $commentId = $body['id'];

    $commentDetail = firstRaw("SELECT comment.*, blog.title, users.fullname, users.email as user_email, groups.name as group_name
                            FROM comment INNER JOIN blog ON comment.blog_id=blog.id
                                         LEFT JOIN users ON comment.user_id = users.id
                                         LEFT JOIN groups ON users.group_id = groups.id
                            WHERE comment.id='$commentId'");
    /* echo '<pre>';
    print_r($commentDetail);
    echo '</pre>'; */
    if (empty($commentDetail)) {
        //Không Tồn tại
        redirect('admin?module=comments');
    }
} else {
    redirect('admin?module=comments');
}

// xử lí cập nhật comment người dùng
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi

    if (empty($commentDetail['user_id'])) {
        // Validate họ tên: bắt buộc phải nhập
        if (empty(trim($body['name']))) {
            $errors['name']['require'] = 'Họ tên bắt buộc phải nhập';
        }

        // validate email: bắt buộc phải nhập và định dạng email
        if (empty(trim($body['email']))) {
            $errors['email']['require'] = 'Email bắt buộc phải nhập';
        } else if (!isEmail(trim($body['email']))) {
            $errors['email']['isEmail'] = 'Email không hợp lệ';
        }

        // validate nội dung: bắt buộc phải nhập
        if (empty(trim($body['content']))) {
            $errors['content']['require'] = 'Nội dung bắt buộc phải nhập';
        }
    }

    // kiểm tra mảng errors
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataUpdate = [
            
            'content' => trim($body['content']),
            'status' => trim($body['status']),
            'update_at' => date('Y-m-d H:i:s'),
        ];

        if (empty($commentDetail['user_id'])) {
            $dataUpdate = array_merge($dataUpdate, [
                'name' => trim($body['name']),
                'email' => trim($body['email']),
                'website' => trim($body['website']),
            ]);
        }

        $condition = "id = $commentId";
        $updateStatus = update('comment', $dataUpdate, $condition);

        if ($updateStatus) {
            setFlashData('msg', 'Cập nhật bình luận thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    } else {
        // có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
    }
    // load lại trang sửa hiện tại
    redirect('admin?module=comments&action=edit&id=' . $commentId);
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($commentDetail)) {
    $old = $commentDetail;
}

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msgType);
        ?>
        <form action="" method="post">
            <p><b>Bình luận từ bài viết:</b> <a href="<?php echo _WEB_HOST_ROOT . '/?module=blog&action=detail&id=' . $commentDetail['blog_id'] ?>" target="_blank"><?php echo $commentDetail['title'] ?></a></p>

            <?php
            if (!empty($commentDetail['parent_id'])) {
                $commentData = getComment($commentDetail['parent_id']);
                if (!empty($commentData['name'])) {
                    echo '<p><strong>Trả lời bình luận: </strong>' . $commentData['name'] . '</p>';
                }
            }
            ?>
            <?php if (empty($commentDetail['user_id'])) : ?>
                <h4>Thông tin cá nhân</h4>
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" class="form-control slug" name="name" placeholder="Họ và tên..." value="<?php echo old('name', $old) ?>">
                    <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
                </div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control slug" name="email" placeholder="Email..." value="<?php echo old('email', $old) ?>">
                    <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                </div>

                <div class="form-group">
                    <label for="">Website</label>
                    <input type="text" class="form-control slug" name="website" placeholder="Website..." value="<?php echo old('website', $old) ?>">
                </div>
            <?php else : ?>
                <h4>Thông tin người dùng</h4>
                <p>- Họ tên: <?php echo $commentDetail['fullname']; ?></p>
                <p>- Email: <?php echo $commentDetail['user_email']; ?></p>
                <p>- Quyền: <?php echo $commentDetail['group_name']; ?></p>
            <?php endif; ?>

            <h4>Chi tiết bình luận</h4>
            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea rows="6" name="content" class="form-control" placeholder="Nội dung..."><?php echo old('content', $old) ?></textarea>
                <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="0" <?php echo old('status', $old) == 0 ? 'selected' : false; ?>>Chưa duyệt</option>
                    <option value="1" <?php echo old('status', $old) == 1 ? 'selected' : false; ?>>Đã duyệt</option>
                </select>
                <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="<?php echo getLinkAdmin('comments', 'lists') ?>" class="btn btn-success">Quay lại</a>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);
