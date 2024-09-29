<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật trang',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// lấy dữ liệu cũ của trang
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])){
    $pageId = $body['id'];

    $pageDetail = firstRaw("SELECT * FROM `pages` WHERE id='$pageId'");

    if (empty($pageDetail)){
        //Không Tồn tại
        redirect('admin?module=pages');
    }

}else{
    redirect('admin?module=pages');
}


// xử lí cập nhật trang
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi
    // Validate tên trang: bắt buộc phải nhập
    if(empty(trim($body['title'] ))) {
        $errors['title']['require'] = 'Tiêu đề trang bắt buộc phải nhập';
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
        $dataUpdate = [
            'title'=> trim($body['title']),
            'slug'=> trim($body['slug']),
            'content'=> trim($body['content']),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        $condition = "id=$pageId";
        $updateStatus = update('pages', $dataUpdate, $condition);
        if ($updateStatus) { 
            setFlashData('msg', 'Cập nhật trang thành công');
            setFlashData('msg_type', 'success');
        }
        else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    }
    else {
        // có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
    }
    // load lại trang sửa hiện tại
    redirect('admin?module=pages&action=edit&id='.$pageId);
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($pageDetail)) {
    $old = $pageDetail;
}

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
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="<?php echo getLinkAdmin('pages', 'lists') ?>" class="btn btn-success">Quay lại</a>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);