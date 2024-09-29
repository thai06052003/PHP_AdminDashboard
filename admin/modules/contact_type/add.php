<?php
// xử lí thêm phòng ban
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi
    // Validate tên phòng ban: bắt buộc phải nhập, >=4 ký tự
    if (empty(trim($body['name']))) {
        $errors['name']['require'] = 'Tên phòng ban bắt buộc phải nhập';
    } else if (strlen(trim($body['name'])) < 4) {
        $errors['name']['min'] = 'Họ tên phải lơn hơn 4 kí tự';
    }

    // kiểm tra mảng errors
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataInsert = [
            'name' => $body['name'],
            'create_at' => date('Y-m-d H:i:s'),
        ];
        $insertStatus = insert('contact_type', $dataInsert);
        if ($insertStatus) {
            setFlashData('msg', 'Thêm mới phòng ban thành công');
            setFlashData('msg_type', 'success');
            redirect('admin?module=contact_type');   // chuyển hướng sang trang list

        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
        redirect('admin?module=contact_type');   // load lại trang thêm
    } else {
        // có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('admin?module=contact_type');   // load lại trang thêm phòng ban
    }
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>
<h4>Thêm phòng ban</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên phòng ban</label>
        <input type="text" class="form-control" name="name" placeholder="Tên phòng ban" value="<?php echo old('name', $old) ?>"></input>
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
    </div>

    <button type="submit" class="btn btn-primary">Thêm phòng ban mới</button>
</form>