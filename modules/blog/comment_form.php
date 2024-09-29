<?php

$commentName = null;
if (!empty(getBody('get')['comment_id'])) {
    $commentId = getBody('get')['comment_id'];
    $commentName = $commentData[$commentId]['name'];
}

if (!empty(islogin())) {
    $userId = islogin()['user_id'];
    $userDetail = firstRaw("SELECT fullname, email FROM users WHERE id=$userId");
}

if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];

    if (empty($userId)) {
        // Validate name
        if (empty(trim($body['name']))) {
            $errors['name']['required'] = 'Tên không được để trống';
        } else if (strlen(trim($body['name'])) < 5) {
            $errors['name']['min'] = 'Tên phải >= 5 ký tự';
        }

        // validate email
        if (empty($body['email'])) {
            $errors['email']['required'] = 'Email bắt buộc phải nhập';
        } else if (!isEmail(trim($body['email']))) {
            $errors['email']['isEmail'] = 'Email không hợp lệ';
        }

        // validate content
        if (empty(trim($body['content']))) {
            $errors['content']['required'] = 'Nội dung không được để trống';
        } else if (strlen(trim($body['content'])) < 10) {
            $errors['content']['min'] = 'Nội dung phải >= 10 ký tự';
        }
    }



    if (empty($errors)) {
        // lưu tất cả thông tin vào cookie
        if (empty($userId)) {
            $commentInfo = [
                'name' => trim(strip_tags($body['name'])),
                'email' => trim(strip_tags($body['email'])),
                'website' => trim(strip_tags($body['website'])),
            ];
            setcookie('commentInfo', json_encode($commentInfo), time() + 86400 * 30);
        }


        $dataInsert = [
            'content' => trim(strip_tags($body['content'])),
            'parent_id' => 0,
            'blog_id' => $id,
            'user_id' => !empty($userId) ? $userId : NULL,
            'status' => 0,
            'create_at' => date('Y-m-d H:i:s')
        ];

        // xử lí submmit
        if (!empty($userId)) {
            $dataInsert['name'] = $userDetail['fullname'];
            $dataInsert['email'] = $userDetail['email'];
        }
        else {
            $dataInsert['name'] = trim(strip_tags($body['name']));
            $dataInsert['email'] = trim(strip_tags($body['email']));
            $dataInsert['website'] = trim(strip_tags($body['website']));
        }

        if (!empty($commentId)) {
            $dataInsert['parent_id'] = $commentId;
            $dataInsert['status']  = 1; // bỏ duyệt khi trả lời
        }

        $insertStatus = insert('comment', $dataInsert);

        if ($insertStatus) {
            if (empty($commentId)) {
                setFlashData('msg', 'Bình luận đã được gửi thành công, vui lòng chờ duyệt ');
            } else {
                setFlashData('msg', 'Bình luận đã được gửi thành công ');
            }
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Bạn không thể gửi bình luận vào lúc này vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
    }
    $linkBlog = getLinkModule('blog', $id).'#comment-form';
    redirect($linkBlog, true);
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

// Lấy dữ liệu từ cookie
$commentInfo = [];
if (!empty($_COOKIE['commentInfo'])) {
    $commentInfo = json_decode(($_COOKIE['commentInfo']), true);
}

?>
<div class="comments-form" id="comment-form">
    <h2 class="title"><?php echo (!empty($commentName)) ? 'Trả lời bình luận: ' . $commentName . ' <a href="' . _WEB_HOST_ROOT . '/?module=blog&action=detail&id=' . $id . '"><i class="fa fa-times"></i>  Hủy</a>' : 'Viết bình luận'; ?></h2>
    <?php
    // check login
    if (!empty($userId)) {
        $userDetail = getUserInfo($userId);
        echo '<p>Bạn đang đăng nhập với tài khoản <b>' . $userDetail['fullname'] . '</b> - <a href="' . _WEB_HOST_ROOT_ADMIN . '?module=auth&action=logout' . '">Đăng xuất</a></p>';
    }

    getMsg($msg, $msgType);
    ?>
    <!-- Contact Form -->
    <form class="form" method="post">
        <div class="row">
            <?php if (empty($userId)) : ?>
                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Tên của bạn" value="<?php echo old('name', $commentInfo) ?>">
                        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email của bạn" value="<?php echo old('email', $commentInfo) ?>">
                        <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <input type="url" name="website" placeholder="Website của bạn" value="<?php echo old('website', $commentInfo) ?>">
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12">
                <div class="form-group">
                    <textarea name="content" rows="5" placeholder="Nội dung bình luận"></textarea>
                    <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group button">
                    <button type="submit" class="btn primary">Gửi bình luận</button>
                </div>
            </div>
        </div>
    </form>
    <!--/ End Contact Form -->
</div>