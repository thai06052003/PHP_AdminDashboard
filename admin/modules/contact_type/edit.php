<?php
// lấy dữ liệu cũ của phòng ban người dùng
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])){
    $contactTypeId = $body['id'];

    $contactTypeDetail = firstRaw("SELECT * FROM `contact_type` WHERE id='$contactTypeId'");

    if (empty($contactTypeDetail)){
        //Không Tồn tại
        redirect('admin?module=contact_type');
    }

}else{
    redirect('admin?module=contact_type');
}


// xử lí cập nhật phòng ban người dùng
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi
    // Validate tên phòng ban: bắt buộc phải nhập, >=4 ký tự
    if(empty(trim($body['name'] ))) {
        $errors['name']['require'] = 'Tên phòng ban bắt buộc phải nhập';
    }
    else if (strlen(trim($body['name'])) < 4) {
        $errors['name']['min'] = 'Họ tên phải lơn hơn 4 kí tự';
    }

    // kiểm tra mảng errors
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataUpdate = [
            'name'=> trim($body['name']),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        $condition = "id=$contactTypeId";
        $updateStatus = update('contact_type', $dataUpdate, $condition);
        if ($updateStatus) { 
            setFlashData('msg', 'Cập nhật phòng ban người dùng thành công');
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
    redirect('admin?module=contact_type&action=lists&view=edit&id='.$contactTypeId);
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($contactTypeDetail)) {
    $old = $contactTypeDetail;
}

?>

<h4>Cập nhật phòng ban</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên phòng ban</label>
        <input type="text" class="form-control" name="name" placeholder="Tên phòng ban"  value="<?php echo old('name', $old) ?>"></input>
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
    </div>
    <button type="submit" class="btn btn-primary mr-2">Cập nhật phòng ban mới</button>
    <a href="<?php echo getLinkAdmin('contact_type', 'lists') ?>" class="btn btn-success">Quay lại</a>
</form>