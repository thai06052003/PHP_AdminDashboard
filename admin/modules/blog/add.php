<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thêm bài viết',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Lấy userId đăng nhập
$userId = islogin()['user_id'];

// xử lí thêm blog người dùng
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi
    // Validate tên blog: bắt buộc phải nhập
    if(empty(trim($body['title'] ))) {
        $errors['title']['require'] = 'Tên blog bắt buộc phải nhập';
    }

    // validate slug: bắt buộc phải nhập
    if(empty(trim($body['slug'] ))) {
        $errors['slug']['require'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
    }

    // validate nội dung: bắt buộc phải nhập
    if(empty(trim($body['description'] ))) {
      $errors['description']['require'] = 'Nội dung bắt buộc phải nhập';
    }

    // validate nội dung: bắt buộc phải nhập
    if(empty(trim($body['content'] ))) {
        $errors['content']['require'] = 'Nội dung bắt buộc phải nhập';
    }

    // validate chuyên mục: bắt buộc phải chọn
    if(empty(trim($body['category_id'] ))) {
      $errors['category_id']['require'] = 'Nội dung bắt buộc phải chọn';
    }

    // validate ảnh đại diện: bắt buộc phải chọn
    if(empty(trim($body['thumbnail'] ))) {
      $errors['thumbnail']['require'] = 'Nội dung bắt buộc phải chọn';
    }

    // kiểm tra mảng errors
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataInsert = [
            'title'=> trim($body['title']),
            'slug'=> trim($body['slug']),
            'content'=> trim($body['content']),
            'user_id'=> $userId,
            'category_id' => trim($body['category_id']),
            'thumbnail' => trim($body['thumbnail']),
            'description' => trim($body['description']),
            'create_at' => date('Y-m-d H:i:s'),
        ];
        $insertStatus = insert('blog', $dataInsert);
        if ($insertStatus) { 
            setFlashData('msg', 'Thêm mới blog thành công');
            setFlashData('msg_type', 'success');
            redirect('admin?module=blog');   // chuyển hướng sang blog list

        }
        else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
        redirect('admin?module=blog&action=add');   // load lại blog thêm blog
    }
    else {
      // có lỗi xảy ra
      setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
      setFlashData('msg_type', 'danger');
      setFlashData('errors', $errors);
      setFlashData('old', $body);
      redirect('admin?module=blog&action=add');   // load lại blog thêm blog
    }
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

// Lấy dữ liệu tất cả chuyên mục
$allCategories = getRaw("SELECT id, name FROM blog_categories ORDER BY name");

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
            getMsg($msg, $msgType);
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tiêu đề</label>
                <input type="text" class="form-control slug" name="title" placeholder="Tiêu đề..."
                    value="<?php echo old('title', $old) ?>">
                <?php echo form_error('title', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh..."
                    value="<?php echo old('slug', $old) ?>">
                <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
                <p class="render-link"><b>Link</b>: <span></span></p>
            </div>

            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="description" class="form-control"
                    placeholder="Mô tả..."><?php echo old('description', $old) ?></textarea>
                <?php echo form_error('description', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor"
                    placeholder="Nội dung..."><?php echo old('content', $old) ?></textarea>
                <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
              <label for="">Chọn chuyên mục</label>
              <select name="category_id" id="" class="form-control">
                <option value="0">Chọn chuyên mục</option>
                <?php
                if (!empty($allCategories)):
                    foreach ($allCategories as $item):
                ?>
                <option value="<?php echo $item['id'] ?>"
                    <?php echo old('category_id', $old) == $item['id'] ? 'selected' : false; ?>>
                    <?php echo $item['name']?></option>
                <?php
                    endforeach;
                endif;
                ?>
              </select>
              <?php echo form_error('category_id', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Ảnh đại diện</label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="thumbnail" placeholder="Đường dẫn ảnh..." value="<?php echo old('thumbnail', $old) ?>">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <?php echo form_error('thumbnail', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="<?php echo getLinkAdmin('blog', 'lists') ?>" class="btn btn-success">Quay lại</a>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);