<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
// file này chứa chức năng đặt lại mật khẩu
layout('header-login', 'admin');
echo '<div class="container"><br>';

$token = getBody()['token'];
if ( !empty($token)) {
    // truy vấn kiểm tra token
    $tokenQuery = firstRaw("SELECT id, email FROM users WHERE forget_token = '$token'");
    if ( !empty($tokenQuery) ) {
        $user_id = $tokenQuery["id"];
        $email = $tokenQuery["email"];
        if ( isPost() ) {
            $body = getBody();
            $errors = [];   // mảng lưu trữu các lỗi

            // validate mật khẩu: bắt buộc phải nhập, lớn hơn hoặc băng 8 kí tự
            if (empty(trim($body['password'] ))) {
                $errors['password']['require'] = 'Mật khẩu bắt buộc phải nhập';
            }
            else if (strlen(trim($body['password'])) <= 8) {
                $errors['password']['min'] = 'Mật khẩu không được nhỏ hơn 8 ký tự';
            }

            // Validate nhập lại mật khẩu: bắt buộc phải nhập, giống trùng mật khẩu
            if (empty(trim($body['confirm_password'] ))) {
                $errors['confirm_password']['require'] = 'Xác nhận mật khẩu không được để trống';
            }
            else if (trim($body['password']) != trim($body['confirm_password'])) {
                $errors['confirm_password']['match'] = 'Hai mật khẩu không khớp nhau';
            }

            // kiểm tra mảng errors
            if (empty($errors)) {
                // không có lỗi xảy ra -> xử lí update mật khẩu
                $passwordHash = password_hash($body['password'], PASSWORD_DEFAULT);
                $dataUpdate = [
                    'password' => $passwordHash,
                    'forget_token' => null,
                    'update_at' => date('Y-m-d H:i:s'),
                ];
                $updateStatus = update('users', $dataUpdate, "id=$user_id");
                if ( $updateStatus ) {
                    setFlashData('msg', 'Cập nhật mật khẩu thành công');
                    setFlashData('msg_type', 'success');

                    // gửi email thông báo khi hoàn thành
                    $subject = 'Bạn vừa đổi mật khẩu';
                    $content = 'Chúc mừng bạn vừa đổi mật khẩu thành công';
                    sendMail($email, $subject, $content);
                    redirect('?module=auth&action=login');
                }
                else {
                    setFlashData('msg', 'Lỗi hệ thống, bạn không thể đổi mật khẩu');
                    setFlashData('msg_type', 'danger');
                redirect('?module=auth&action=reset&token='.$token);

                }
            }
            else {
                setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
                setFlashData('msg_type', 'danger');
                setFlashData('errors', $errors);
                redirect('?module=auth&action=reset&token='.$token);
            }
        }   // end isPost()
        $msg = getFlashData('msg');
        $msgType = getFlashData('msg_type');
        $errors = getFlashData('errors');
        ?>
        <div class="row text-left">
            <div class="col-6" style="margin: 20px auto;">
                <h3 class="text-center text-uppercase">Đặt lại mật khẩu</h3>
                <?php getMsg($msg, $msgType);  ?>
                <form action="" method="post">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Mật khẩu mới</label>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu mới ...">
                        <?php echo form_error('password', $errors, '<span class="error">', '</span>'); ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Nhập lại mật khẩu mới</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu mới ...">
                        <?php echo form_error('confirm_password', $errors, '<span class="error">', '</span>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Xác nhận</button>
                    <hr>
                    <p class="text-center"><a href="?module=auth&action=login" style="text-decoration: none;">Đăng nhập</a></p>
                    <p class="text-center"><a href="?module=auth&action=register" style="text-decoration: none;">Đăng kí tài khoản</a></p>
                    <input type="hidden" name="token" value="<?php echo $token ?>">
                </form>
            </div>
        </div>
        <?php
    }
    else {
    getMsg('Liên kết không tồn tại', 'danger');
    }
}
else {
    getMsg('Liên kết không tồn tại hoặc đã hết hạn', 'danger');
}
echo '</div>';
layout('footer-login', 'admin');