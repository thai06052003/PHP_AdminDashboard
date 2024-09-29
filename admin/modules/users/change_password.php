<?php
$data = [
    'pageTitle' => 'Đổi mật khẩu',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userId = islogin()['user_id'];
$userDetail = getUserInfo( $userId );
setFlashData('userDetail', $userDetail);

// xử lý cập nhật thông tin cá nhân
if (isPost()) {
    // validete form
    $body = getBody();  // lấy tất cả dữ liệu trong form
    $errors = [];   // mảng lưu trữ các lỗi

    // validate mật khẩu cũ: bắt buộc phải nhập, trùng với mật khẩu trong database
    if (empty(trim($body['old_password']))) {
        $errors['old_password']['required'] = 'Mật khẩu cũ bắt buộc phải nhập';
    }
    else{
        //$errors['old_password']['min'] = 'Họ tên phải lớn hơn 5 ký tự';
        $oldPassword = trim($body['old_password']);
        $hashPassword = $userDetail['password'];
        if (!password_verify($oldPassword, $hashPassword)) {
            $errors['old_password']['match'] = 'Mật khẩu cũ không chính xác';
        }
    }
    
    // validate mật khẩu: bắt buộc phải nhập, lớn hơn hoặc băng 8 kí tự
    if (empty(trim($body['password'] ))) {
        $errors['password']['require'] = 'Mật khẩu bắt buộc phải nhập';
    }
    else if (strlen(trim($body['password'])) < 8) {
        $errors['password']['min'] = 'Mật khẩu không được nhỏ hơn 8 ký tự';
    }

    // Validate nhập lại mật khẩu: bắt buộc phải nhập, giống trùng mật khẩu
    if (empty(trim($body['confirm_password'] ))) {
        $errors['confirm_password']['require'] = 'Xác nhận mật khẩu không được để trống';
    }
    else if (trim($body['password']) != trim($body['confirm_password'])) {
        $errors['confirm_password']['match'] = 'Hai mật khẩu không khớp nhau';
    }
    
    
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataUpdate = [
            'password' => password_hash($body['password'], PASSWORD_DEFAULT),
            'update_at'=> date('Y-m-d H:i:s'),
        ];

        $condition = "id=$userId";
        $updateStatus = update('users', $dataUpdate, $condition);
        if ($updateStatus) { 
            setFlashData('msg', 'Đổi mật khẩu thành công. Bạn có thể đăng nhập mật khẩu mới ngay bây giờ');
            setFlashData('msg_type', 'success');

            // Thiết lập gửi email
            $subject = $userDetail['fullname'].' thay đổi mật khẩu thành công';
            $content = 'Chào bạn: '.$userDetail['fulname'].'<br>';
            $content.= 'Chúc mừng bạn đã thay đổi mật khẩu thành công. Hiện bạn có thể đăng nhập với mật khẩu mới <br>';
            $content.= 'Nếu không phải bạn thay đổi, vui lòng liên hệ ngay với chúng tôi. <br>';
            $content.= 'Trân trọng!';

            // Tiến hành gửi email
            sendMail($userDetail['email'], $subject, $content);
            // Đăng xuất
            redirect('admin?module=auth&action=logout');
        }
        else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    }else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
    }
    redirect('admin?module=users&action=change_password');   // load lại trang thêm người dùng
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');

$userDetail = getFlashData('userDetail');

/* echo '<pre>';
print_r($errors);
echo '</pre>'; */
//print_r($userDetail);
?>
    <!-- /.content-header -->
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php
        getMsg($msg, $msgType);
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Mật khẩu cũ</label>
                <input type="password" class="form-control" name="old_password" placeholder="Mật khẩu cũ...">
                <?php echo form_error('old_password', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Mật khẩu mới</label>
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới...">
                <?php echo form_error('password', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Nhập lại mật khẩu mới</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu mới...">
                <?php echo form_error('confirm_password', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


<?php
layout("footer", 'admin', $data);