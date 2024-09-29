<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thêm trang',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Lấy userId đăng nhập
$userId = islogin()['user_id'];

// xử lí thêm trang người dùng
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi
    // Validate tên trang: bắt buộc phải nhập
    if(empty(trim($body['title'] ))) {
        $errors['title']['require'] = 'Tên trang bắt buộc phải nhập';
    }

    // validate slug bắt buộc phải nhập
    if(empty(trim($body['slug'] ))) {
        $errors['slug']['require'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
    }

    // validate nội dung bắt buộc phải nhập
    if(empty(trim($body['content'] ))) {
        $errors['content']['require'] = 'Nội dung bắt buộc phải nhập';
    }

    // kiểm tra mảng errors
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataInsert = [
            'title'=> trim($body['title']),
            'slug'=> trim($body['slug']),
            'content'=> trim($body['content']),
            'user_id'=> $userId,
            'create_at' => date('Y-m-d H:i:s'),
        ];
        $insertStatus = insert('pages', $dataInsert);
        if ($insertStatus) { 
            setFlashData('msg', 'Thêm mới trang thành công');
            setFlashData('msg_type', 'success');
            redirect('admin?module=pages');   // chuyển hướng sang trang list

        }
        else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
        redirect('admin?module=pages&action=add');   // load lại trang thêm trang
    }
    else {
        // có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('admin?module=pages&action=add');   // load lại trang thêm trang
    }
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
            getMsg($msg, $msgType);
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tên trang</label>
                <input type="text" class="form-control slug" name="title" placeholder="Tên trang..." value="<?php echo old('title', $old) ?>">
                <?php echo form_error('title', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh..." value="<?php echo old('slug', $old) ?>">
                <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
                <p class="render-link"><b>Link</b>: <span></span></p>
            </div>      

            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor" placeholder="Nội dung..."><?php echo old('content', $old) ?></textarea>
                <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="<?php echo getLinkAdmin('pages', 'lists') ?>" class="btn btn-success">Quay lại</a>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);