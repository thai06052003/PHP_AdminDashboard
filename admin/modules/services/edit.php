<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật dịch vụ',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if (!$checkPermission) {
    redirectPermission();
}

// lấy dữ liệu cũ của dịch vụ
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])){
    $serviceId = $body['id'];

    $serviceDetail = firstRaw("SELECT * FROM `services` WHERE id='$serviceId'");

    if (empty($serviceDetail)){
        //Không Tồn tại
        redirect('admin?module=services');
    }

}else{
    redirect('admin?module=services');
}


// xử lí cập nhật dịch vụ
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi
    // Validate tên dịch vụ: bắt buộc phải nhập
    if(empty(trim($body['name'] ))) {
        $errors['name']['require'] = 'Tên dịch vụ bắt buộc phải nhập';
    }

    // validate slug bắt buộc phải nhập
    if(empty(trim($body['slug'] ))) {
        $errors['slug']['require'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
    }

    // validate icon bắt buộc phải nhập
    if(empty(trim($body['icon'] ))) {
        $errors['icon']['require'] = 'Icon bắt buộc phải nhập';
    }

    // validate nội dung bắt buộc phải nhập
    if(empty(trim($body['content'] ))) {
        $errors['content']['require'] = 'Nội dung bắt buộc phải nhập';
    }

    // kiểm tra mảng errors
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataUpdate = [
            'name'=> trim($body['name']),
            'slug'=> trim($body['slug']),
            'icon'=> trim($body['icon']),
            'description'=> trim($body['description']),
            'content'=> trim($body['content']),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        $condition = "id=$serviceId";
        $updateStatus = update('services', $dataUpdate, $condition);
        if ($updateStatus) { 
            setFlashData('msg', 'Cập nhật dịch vụ thành công');
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
    redirect('admin?module=services&action=edit&id='.$serviceId);
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($serviceDetail)) {
    $old = $serviceDetail;
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
                <label for="">Tên dịch vụ</label>
                <input type="text" class="form-control slug" name="name" placeholder="Tên dịch vụ..." value="<?php echo old('name', $old) ?>">
                <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh..." value="<?php echo old('slug', $old) ?>">
                <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
                <p class="render-link"><b>Link</b>: <span></span></p>
            </div>
            
            <div class="form-group">
                <label for="">Icon</label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="icon" placeholder="Đường mã ảnh hoặc mã icon..." value="<?php echo old('icon', $old) ?>">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <?php echo form_error('icon', $errors, '<span class="error">', '</span>'); ?>
            </div>
            
            <div class="form-group">
                <label for="">Mô tả ngắn</label>
                <textarea name="description" class="form-control editor" placeholder="Mô tả ngắn..."><?php echo old('description', $old) ?></textarea>
                <?php echo form_error('description', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor" placeholder="Nội dung..."><?php echo old('content', $old) ?></textarea>
                <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="<?php echo getLinkAdmin('services', 'lists') ?>" class="btn btn-success">Quay lại</a>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);