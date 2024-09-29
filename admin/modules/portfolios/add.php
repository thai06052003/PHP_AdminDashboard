<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thêm dự án',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Lấy userId đăng nhập
$userId = islogin()['user_id'];

// xử lí thêm dự án người dùng
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi
    // Validate tên dự án: bắt buộc phải nhập
    if (empty(trim($body['name']))) {
        $errors['name']['require'] = 'Tên dự án bắt buộc phải nhập';
    }

    // validate slug: bắt buộc phải nhập
    if (empty(trim($body['slug']))) {
        $errors['slug']['require'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
    }

    // validate nội dung: bắt buộc phải nhập
    if (empty(trim($body['content']))) {
        $errors['content']['require'] = 'Nội dung bắt buộc phải nhập';
    }

    // validate video: bắt buộc phải nhập
    if (empty(trim($body['video']))) {
        $errors['video']['require'] = 'Link video bắt buộc phải nhập';
    }

    // validate danh mục: bắt buộc chọn
    if (empty(trim($body['portfolio_category_id']))) {
        $errors['portfolio_category_id']['require'] = 'Danh mục bắt buộc phải chọn';
    }

    // validate ảnh đại diện: bắt buộc phải nhập
    if (empty(trim($body['thumbnail']))) {
        $errors['thumbnail']['require'] = 'Ảnh đại diện bắt buộc phải chọn';
    }

    // Validdate thư viện ảnh:
    
    if (!empty($body['gallery'])) {
        $galleryArr = $body['gallery'];
        foreach ($galleryArr as $key => $item) {
            if (empty(trim($item))) {
                $errors['gallery']['require'][$key] = 'Vui lòng chọn ảnh';
            }
        }
    }
    // kiểm tra mảng errors
    if (empty($errors)) {
        // không có lỗi xảy ra
        $dataInsert = [
            'name' => trim($body['name']),
            'slug' => trim($body['slug']),
            'content' => trim($body['content']),
            'user_id' => $userId,
            'description' => trim($body['description']),
            'video' => trim($body['video']),
            'portfolio_category_id' => trim($body['portfolio_category_id']),
            'thumbnail' => trim($body['thumbnail']),
            'create_at' => date('Y-m-d H:i:s'),
        ];
        $insertStatus = insert('portfolios', $dataInsert);


        if ($insertStatus) {

            // Xử lý thêm ảnh dự án
            $currentId = insertId();    // lấy id vừa insert
            if (!empty($galleryArr)) {
                foreach ($galleryArr as $item) {
                    $dataImages = [
                        'portfolio_id' => $currentId,
                        'image' => trim($item),
                        'create_at' => date('Y-m-d H:i:s'),
                    ];
                    insert('portfolio_images', $dataImages);
                }
            }

            setFlashData('msg', 'Thêm mới dự án thành công');
            setFlashData('msg_type', 'success');
            redirect('admin?module=portfolios');   // chuyển hướng sang dự án list

        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
        redirect('admin?module=portfolios&action=add');   // load lại dự án thêm dự án
    } else {
        // có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('admin?module=portfolios&action=add');   // load lại dự án thêm dự án
    }
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

echo '<pre>';
print_r($old);
echo '</pre>';

// Truy vấn lấy danh sách danh mục
$allCategory = getRaw("SELECT * FROM portfolio_categories ORDER BY name")

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msgType);
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tên dự án</label>
                <input type="text" class="form-control slug" name="name" placeholder="Tên dự án..." value="<?php echo old('name', $old) ?>">
                <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh..." value="<?php echo old('slug', $old) ?>">
                <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
                <p class="render-link"><b>Link</b>: <span></span></p>
            </div>

            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="description" class="form-control" placeholder="Mô tả..."><?php echo old('description', $old) ?></textarea>
            </div>

            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor" placeholder="Nội dung..."><?php echo old('content', $old) ?></textarea>
                <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Link video</label>
                <input type="url" name="video" class="form-control" placeholder="Link video..." value="<?php echo old('video', $old) ?>">
                <?php echo form_error('video', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Chọn danh mục</label>
                <select name="portfolio_category_id" id="" class="form-control">
                    <option value="0">Chọn danh mục</option>
                    <?php
                    if (!empty($allCategory)) :
                        foreach ($allCategory as $item) :
                    ?>
                            <option value="<?php echo $item['id'] ?>" <?php echo old('portfolio_category_id', $old) == $item['id'] ? 'selected' : false ?>><?php echo $item['name'] ?></option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </select>
                <?php echo form_error('portfolio_category_id', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Ảnh đại diện</label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name=" thumbnail" placeholder="Đường dẫn ảnh..." value="<?php echo old('thumbnail', $old) ?>">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <?php echo form_error('thumbnail', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Ảnh dự án</label>
                <div class="gallery-images">
                    <?php
                    $oldGallery = old('gallery', $old);
                    if (!empty($oldGallery)) {
                        $galleryErrors = $errors['gallery'];

                        foreach ($oldGallery as $key => $item) {
                    ?>
                            <!-- Begin gallery item -->
                            <div class="gallery-item">
                                <div class="row">
                                    <div class="col-11">
                                        <div class="row ckfinder-group">
                                            <div class="col-10">
                                                <input type="text" class="form-control image-render" name="gallery[]" placeholder="Đường dẫn ảnh..." value="<?php echo (!empty(($item))) ? $item : false; ?>">
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                                            </div>
                                        </div>
                                        <?php
                                        echo (!empty($galleryErrors['require'][$key])) ? '<span class="error">'.$galleryErrors['require'][$key].'</span>' : false;
                                        ?>
                                    </div>
                                    
                                    <div class="col-1">
                                        <a href="#" class="remove btn btn-danger btn-block">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- End gallery item -->
                    <?php
                        }
                    }
                    ?>
                </div>
                <p class="" style="margin-top: 10px;">
                    <a href="#" class="btn btn-warning add-gallery">Thêm ảnh</a>
                </p>

            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="<?php echo getLinkAdmin('portfolios', 'lists') ?>" class="btn btn-success">Quay lại</a>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);
