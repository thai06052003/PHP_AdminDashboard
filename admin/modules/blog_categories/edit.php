<?php
// lấy dữ liệu cũ của danh mục người dùng
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])){
    $categoryId = $body['id'];

    $categoryDetail = firstRaw("SELECT * FROM `blog_categories` WHERE id='$categoryId'");

    if (empty($categoryDetail)){
        //Không Tồn tại
        redirect('admin?module=blog_categories');
    }

}else{
    redirect('admin?module=blog_categories');
}


// xử lí cập nhật danh mục người dùng
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

    // Validate slug: bắt buộc phải nhập
    if(empty(trim($body['slug'] ))) {
        $errors['slug']['require'] = 'Tên danh mục bắt buộc phải nhập';
    }

    // kiểm tra mảng errors
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataUpdate = [
            'name'=> trim($body['name']),
            'slug'=> trim($body['slug']),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        $condition = "id=$categoryId";
        $updateStatus = update('blog_categories', $dataUpdate, $condition);
        if ($updateStatus) { 
            setFlashData('msg', 'Cập nhật danh mục người dùng thành công');
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
    redirect('admin?module=blog_categories&action=lists&view=edit&id='.$categoryId);
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($categoryDetail)) {
    $old = $categoryDetail;
}

?>

<h4>Cập nhật danh mục</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control slug" name="name" placeholder="Tên danh mục"  value="<?php echo old('name', $old) ?>"></input>
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
    </div>
    <div class="form-group">
        <label for="">Đường dẫn tĩnh</label>
        <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh"  value="<?php echo old('slug', $old) ?>"></input>
        <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
        <p class="render-link"><b>Link</b>: <span></span></p>
    </div>
    <button type="submit" class="btn btn-primary mr-2">Cập nhật danh mục mới</button>
    <a href="<?php echo getLinkAdmin('blog_categories', 'lists') ?>" class="btn btn-success">Quay lại</a>
</form>