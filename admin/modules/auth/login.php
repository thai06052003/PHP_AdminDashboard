<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
// file này chứa thông tin đang nhập
$data = [
    'pageTitle' => 'Đăng nhập hệ thống'
];
layout('header-login', 'admin', $data);

// Kiểm tra trạng thái đăng nhập
if (islogin()) {
    redirect('admin');
}


// Xử lý đăng nhập
if (isPost()) {
    $body = getBody();
    if (!empty(trim($body['email'])) && !empty(trim($body['password']))) {
        // Kiểm tra đăng nhập
        $email = $body['email'];
        $password = $body['password'];
        
        // Truy vấn lấy thông tin user theo email và status == 1
        $userQuery = firstRaw("SELECT id, password FROM users WHERE email='$email' AND status = 1");
        
        if (!empty($userQuery)) {
            $passwordHash = $userQuery['password'];
            $userId = $userQuery['id'];
            if (password_verify($password, $passwordHash)) {
                // Tạo token login
                $tokenLogin = sha1(uniqid().time());

                // Insert dữ liệu vào bảng
                $dataToken = [
                    'user_id' => $userId,
                    'token'=> $tokenLogin,
                    'create_at' => date('Y-m-d H:i:s'),
                ];

                $insertTokenStatus = insert('login_token', $dataToken);
                if (!empty($insertTokenStatus)) {
                    // insert token thành công

                    // Lưu loginToken vào session
                    setSession('loginToken', $tokenLogin);

                    // Chuyển hướng qua trang quản lý users
                    redirect('admin');
                }
                else {
                    setFlashData('msg','Lỗi hệ thống bạn không thể đăng nhập vào lúc này');
                    setFlashData('msg_type','danger');
                    //redirect('?module=auth&action=login');
                }

            }
            else {
                setFlashData('msg','Mật khẩu không chính xác');
                setFlashData('msg_type','danger');
                //redirect('?module=auth&action=login');
            }
        }
        else {
            setFlashData('msg','Email không tồn tại trong hệ thống hoặc chưa được kích hoạt');
            setFlashData('msg_type','danger');
            //redirect('?module=auth&action=login');
        }
    }
    else {
        setFlashData('msg','Vui lòng nhập email và mật khẩu');
        setFlashData('msg_type','danger');
        //redirect('?module=auth&action=login');
    }
    redirect('admin/?module=auth&action=login');
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

?>
<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center text-uppercase">Đăng nhập hệ thống</h3>
        <?php getMsg($msg, $msgType);  ?>
        <form action="" method="post">
            <div class="form-group mb-3">
                <label for="login-email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="login-email" placeholder="Nhập địa chỉ email ...">
            </div>
            <div class="form-group mb-3">
                <label for="login-password" class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="login-password" placeholder="Nhập mật khẩu ...">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Đăng nhập</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=forgot" style="text-decoration: none;">Quên mật khẩu</a></p>
        </form>
    </div>
</div>

<?php
layout('footer-login', 'admin');
?>