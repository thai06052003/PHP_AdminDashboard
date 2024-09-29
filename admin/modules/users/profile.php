<?php
$data = [
    'pageTitle' => 'Cập nhật thông tin cá nhân',
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

    // validate họ tên: bắt buộc nhập >=5 ký tự
    if (empty(trim($body['fullname']))) {
        $errors['fullname']['required'] = 'Họ tên bắt buộc phải nhập';
    }
    else if (strlen(trim($body['fullname'])) < 5) {
        $errors['fullname']['min'] = 'Họ tên phải lớn hơn 5 ký tự';
    }

    // validate email: bắt buộc phải nhập, định dạng email, email phải duy nhất
    if (empty(trim($body['email'] ))) {
        $errors['email']['require'] = 'Email bắt buộc phải nhập';
    }
    else if (!isEmail(trim($body['email']))) {
        $errors['email']['isEmail'] = 'Email không hợp lệ';
    }
    else {
        $email = trim($body['email']);
        $sql = "SELECT id FROM users WHERE email='$email' AND id <> '$userId'";
        if (getRows($sql) > 0) {
            $errors['email']['Unique'] = 'Email đã tồn tại';

        }
    }
    /* echo '<pre>';
    print_r($errors);
    echo '</pre>'; */
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataUpdate = [
            'fullname' => $body['fullname'],
            'email'=> $body['email'],
            'contact_facebook'=> $body['contact_facebook'],
            'contact_twitter'=> $body['contact_twitter'],
            'contact_linkedin'=> $body['contact_linkedin'],
            'contact_pinterest'=> $body['contact_pinterest'],
            'about_content'=> $body['about_content'],
            'update_at'=> date('Y-m-d H:i:s'),
        ];

        $condition = "id=$userId";
        $updateStatus = update('users', $dataUpdate, $condition);
        if ($updateStatus) { 
            setFlashData('msg', 'Cập nhật thông tin thành công');
            setFlashData('msg_type', 'success');

        }
        else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    }else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
    }
    redirect('admin?module=users&action=profile');   // load lại trang thêm người dùng
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

$userDetail = getFlashData('userDetail');
if (!empty($userDetail) && empty($old)) {
    $old = $userDetail;
}
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
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Họ và tên</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Họ và tên..." value="<?php echo old('fullname', $old) ?>">
                        <?php echo form_error('fullname', $errors, '<span class="error">', '</span>'); ?>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email..." value="<?php echo old('email', $old) ?>">
                        <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Facebook</label>
                        <input type="text" class="form-control" name="contact_facebook" placeholder="Facebook..." value="<?php echo old('contact_facebook', $old) ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Twitter</label>
                        <input type="text" class="form-control" name="contact_twitter" placeholder="Twitter..." value="<?php echo old('contact_twitter', $old) ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">LinkedIn</label>
                        <input type="text" class="form-control" name="contact_linkedin" placeholder="LinkedIn..." value="<?php echo old('contact_linkedin', $old) ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Pinterest</label>
                        <input type="text" class="form-control" name="contact_pinterest" placeholder="Pinterest..." value="<?php echo old('contact_pinterest', $old) ?>">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Nội dung giới thiệu</label>
                        <textarea name="about_content" class="form-control" placeholder="Nội dung giới thiệu..."><?php echo old('about_content', $old) ?></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


<?php
layout("footer", 'admin', $data);