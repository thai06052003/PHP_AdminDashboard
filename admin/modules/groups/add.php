<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thêm nhóm người dùng',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// xử lí thêm nhóm người dùng
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi
    // Validate tên nhóm: bắt buộc phải nhập, >=4 ký tự
    if(empty(trim($body['name'] ))) {
        $errors['name']['require'] = 'Tên nhóm bắt buộc phải nhập';
    }
    else if (strlen(trim($body['name'])) < 4) {
        $errors['name']['min'] = 'Họ tên phải lơn hơn 4 kí tự';
    }

    // kiểm tra mảng errors
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataInsert = [
            'name'=> $body['name'],
            'create_at' => date('Y-m-d H:i:s'),
        ];
        $insertStatus = insert('groups', $dataInsert);
        if ($insertStatus) { 
            setFlashData('msg', 'Thêm mới nhóm người dùng thành công');
            setFlashData('msg_type', 'success');
            redirect('admin?module=groups');   // chuyển hướng sang trang list

        }
        else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
        redirect('admin?module=groups&action=add');   // load lại trang thêm người dùng
    }
    else {
        // có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('admin?module=groups&action=add');   // load lại trang thêm nhóm người dùng
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
                <label for="">Tên nhóm</label>
                <input type="text" class="form-control" name="name" placeholder="Tên nhóm..." value="<?php echo old('name', $old) ?>">
                <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="<?php echo getLinkAdmin('groups', 'lists') ?>" class="btn btn-success">Quay lại</a>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);