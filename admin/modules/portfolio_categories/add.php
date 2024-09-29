<?php

// lấy userId đăng nhập
$userId = islogin()['user_id'];

// xử lí thêm danh mục
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi
    // Validate tên danh mục: bắt buộc phải nhập, >=4 ký tự
    if(empty(trim($body['name'] ))) {
        $errors['name']['require'] = 'Tên danh mục bắt buộc phải nhập';
    }
    else if (strlen(trim($body['name'])) < 4) {
        $errors['name']['min'] = 'Họ tên phải lơn hơn 4 kí tự';
    }

    // kiểm tra mảng errors
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataInsert = [
            'name'=> $body['name'],
            'user_id' => $userId,
            'create_at' => date('Y-m-d H:i:s'),
        ];
        $insertStatus = insert('portfolio_categories', $dataInsert);
        if ($insertStatus) { 
            setFlashData('msg', 'Thêm mới danh mục thành công');
            setFlashData('msg_type', 'success');
            redirect('admin?module=portfolio_categories');   // chuyển hướng sang trang list

        }
        else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger'); 
        }
        redirect('admin?module=portfolio_categories');   // load lại trang thêm
    }
    else {
        // có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('admin?module=portfolio_categories');   // load lại trang thêm danh mục
    }
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>
<h4>Thêm danh mục</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control" name="name" placeholder="Tên danh mục"  value="<?php echo old('name', $old) ?>"></input>
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>

    </div>
    <button type="submit" class="btn btn-primary">Thêm danh mục mới</button>
</form>