<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật liên hệ',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// lấy dữ liệu cũ của contacts
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])) {
    $contactId = $body['id'];

    $contactDetail = firstRaw("SELECT * FROM `contacts` WHERE id='$contactId'");

    if (empty($contactDetail)) {
        //Không Tồn tại
        redirect('admin?module=contacts');
    }
} else {
    redirect('admin?module=contacts');
}

/* echo '<pre>';
print_r($contactDetail);
echo '</pre>'; */

// xử lí cập nhật contacts người dùng
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi
    // Validate tên contacts: bắt buộc phải nhập
    if (empty(trim($body['fullname']))) {
        $errors['fullname']['require'] = 'Họ và tên bắt buộc phải nhập';
    }

    // validate nội dung: bắt buộc phải nhập
    if (empty(trim($body['email']))) {
        $errors['email']['require'] = 'Email bắt buộc phải nhập';
    }

    // validate nội dung: bắt buộc phải nhập
    if (empty(trim($body['message']))) {
        $errors['message']['require'] = 'Nội dung bắt buộc phải nhập';
    }

    // validate phòng ban: bắt buộc phải chọn
    if (empty(trim($body['type_id']))) {
        $errors['type_id']['require'] = 'Phòng ban bắt buộc phải chọn';
    }

    // kiểm tra mảng errors
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataUpdate = [
            'fullname' => trim($body['fullname']),
            'email' => trim($body['email']),
            'message' => trim($body['message']),
            'type_id' => trim($body['type_id']),
            'status' => trim($body['status']),
            'note' => trim($body['note']),
            'update_at' => date('Y-m-d H:i:s'),
        ];

        $condition = "id = $contactId";
        $updateStatus = update('contacts', $dataUpdate, $condition);

        if ($updateStatus) {
            setFlashData('msg', 'Cập nhật liên hệ thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    } else {
        // có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
    }
    // load lại trang sửa hiện tại
    redirect('admin?module=contacts&action=edit&id=' . $contactId);
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
if (empty($old) && !empty($contactDetail)) {
    $old = $contactDetail;
}
// Lấy dữ liệu tất cả phòng ban
$allContactType = getRaw("SELECT id, name FROM contact_type ORDER BY name");

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msgType);
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Họ tên</label>
                <input type="text" class="form-control slug" name="fullname" placeholder="Họ và tên..." value="<?php echo old('fullname', $old) ?>">
                <?php echo form_error('fullname', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control slug" name="email" placeholder="Email..." value="<?php echo old('email', $old) ?>">
                <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea row="10" name="message" class="form-control" placeholder="Nội dung..."><?php echo old('message', $old) ?></textarea>
                <?php echo form_error('message', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Phòng ban</label>
                <select name="type_id" id="" class="form-control">
                    <option value="0">Chọn phòng ban</option>
                    <?php
                    if (!empty($allContactType)) :
                        foreach ($allContactType as $item) :
                    ?>
                            <option value="<?php echo $item['id'] ?>" <?php echo old('type_id', $old) == $item['id'] ? 'selected' : false; ?>>
                                <?php echo $item['name'] ?></option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </select>
                <?php echo form_error('type_id', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Trạng thái</label>
                <select name="status" id="" class="form-control">
                    <option value="0" <?php echo (old('status', $old) == 0) ? 'selected' : false  ?>>Chưa xử lí</option>
                    <option value="1" <?php echo (old('status', $old) == 1) ? 'selected' : false  ?>>Đang xử lí</option>
                    <option value="2" <?php echo (old('status', $old) == 2) ? 'selected' : false  ?>>Đã xử lí</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="">Ghi chú</label>
                <textarea row="10" name="note" class="form-control" placeholder="Ghi chú..."><?php echo old('note', $old) ?></textarea>
                <?php echo form_error('note', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="<?php echo getLinkAdmin('contacts', 'lists') ?>" class="btn btn-success">Quay lại</a>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);
