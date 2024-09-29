<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật dự án',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// lấy dữ liệu cũ của dự án
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])){
    $portfolioId = $body['id'];

    $portfolioDetail = firstRaw("SELECT * FROM `portfolios` WHERE id='$portfolioId'");

    // truy vấn lấy thư viện ảnh
    $galleryDetailArr = getRaw("SELECT * FROM portfolio_images WHERE portfolio_id=$portfolioId");

    $galleryData = [];
    $galleryIdsArr = []; // lưu trữ id gallery trong database
    if (!empty($galleryDetailArr)) {
        foreach ($galleryDetailArr as $gallery) {
            $galleryData[] = $gallery['image'];
            $galleryIdsArr[] = $gallery['id'];
        }
    }

    if (empty($portfolioDetail)){
        //Không Tồn tại
        redirect('admin?module=portfolios');
    }

}else{
    redirect('admin?module=portfolios');
}

// xử lí cập nhật dự án người dùng
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form

    $errors = [];   // mảng lưu trữu lỗi
    // Validate tên dự án: bắt buộc phải nhập
    if(empty(trim($body['name'] ))) {
        $errors['name']['require'] = 'Tên dự án bắt buộc phải nhập';
    }

    // validate slug: bắt buộc phải nhập
    if(empty(trim($body['slug'] ))) {
        $errors['slug']['require'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
    }

    // validate nội dung: bắt buộc phải nhập
    if(empty(trim($body['content'] ))) {
        $errors['content']['require'] = 'Nội dung bắt buộc phải nhập';
    }

    // validate video: bắt buộc phải nhập
    if(empty(trim($body['video'] ))) {
        $errors['video']['require'] = 'Link video bắt buộc phải nhập';
    }

    // validate danh mục: bắt buộc chọn
    if(empty(trim($body['portfolio_category_id'] ))) {
        $errors['portfolio_category_id']['require'] = 'Danh mục bắt buộc phải chọn';
    }

    // validate ảnh đại diện: bắt buộc phải nhập
    if(empty(trim($body['thumbnail'] ))) {
        $errors['thumbnail']['require'] = 'Ảnh đại diện bắt buộc phải chọn';
    }
    // Validdate thư viện ảnh:
    /* if (!isset($body['gallery']) || is_null($body['gallery'])) {
        $galleryArr = [];
    }
    else {
        $galleryArr = $body['gallery'];
    } */

    if (!empty($body['gallery'])) {
        $galleryArr = $body['gallery'];
        foreach ($galleryArr as $key => $item) {
            if (empty(trim($item))) {
                $errors['gallery']['require'][$key] = 'Vui lòng chọn ảnh';
            }
        }
    }
    else {
        $galleryArr = [];
    }
    

    // kiểm tra mảng errors
    if (empty($errors)) {
        /* echo '<pre>';
        print_r($galleryArr);
        echo '</pre>';

        echo '<hr>';

        echo '<pre>';
        print_r($galleryData);
        echo '</pre>'; */
        if (count($galleryArr)>count($galleryData)) {       /* lấy số lượng mảng mới - mảng cũ sẽ ra những ảnh cần phải insert, sau đó duyệt các ảnh mới của mảng mới update vào mảng cũ, insert các ảnh mới vào mảng */
            // insert những ảnh còn thiếu và update những ảnh thay đổi
            if (!empty($galleryData)) {
                foreach ($galleryData as $key => $item) {
                    $dataImages = [
                        'image' => $galleryArr[$key],
                        'update_at' => date('Y-m-d H:i:s'),
                    ];
                    // update thư viện ảnh
                    //$condition = "image = '$item'";
                    $condition = "id=".$galleryIdsArr[$key];
                    update('portfolio_images', $dataImages, $condition);
                }
            }
            else {
                $key = -1;
            }
            
            for ($index= $key+1; $index<count($galleryArr);$index++) {      /* galleryArr (là mảng mới) và galleryData (là mảng cũ) lấy vị trí mảng cũ ($key) +1 để bắt đầu duyệt mảng mới */
                $dataImages = [
                    'image' => $galleryArr[$index],
                    'portfolio_id' => $portfolioId,
                    'create_at' => date('Y-m-d H:i:s'),
                ];
                // Insert ảnh còn thiếu
                insert('portfolio_images', $dataImages);
            }
        }
        else if (count($galleryArr)<count($galleryData)) {
            foreach ($galleryArr as $key => $item) {
                $dataImages = [
                    'image' => $item,
                    'update_at' => date('Y-m-d H:i:s'),
                ];
                // update thư viện ảnh
                $condition = "id=".$galleryIdsArr[$key];
                update('portfolio_images', $dataImages, $condition);
            }
            if (is_null($key)) {
                $key = -1;
            }
            for ($index= $key+1; $index<count($galleryData); $index++) {
                // delete ảnh thừa
                $condition = "id=".$galleryIdsArr[$index];
                delete('portfolio_images', $condition);
            }
        } 
        else {
            foreach ($galleryArr as $key => $item) {
                $dataImages = [
                    'image' => $item,
                    'update_at' => date('Y-m-d H:i:s'),
                ];
                // update thư viện ảnh
                $condition = "image = '".$galleryData[$key]."'";
                update('portfolio_images', $dataImages, $condition);
            }
        }

        // không có lỗi xảy ra
        $dataUpdate = [
            'name'=> trim($body['name']),
            'slug'=> trim($body['slug']),
            'content'=> trim($body['content']),
            'description'=> trim($body['description']),
            'video'=> trim($body['video']),
            'portfolio_category_id'=> trim($body['portfolio_category_id']),
            'thumbnail'=> trim($body['thumbnail']),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        $condition = "id=$portfolioId";
        $updateStatus = update('portfolios', $dataUpdate, $condition);
        if ($updateStatus) { 
            setFlashData('msg', 'Cập nhật dự án thành công');
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
    redirect('admin?module=portfolios&action=edit&id='.$portfolioId);
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($portfolioDetail)) {
    $old = $portfolioDetail;
    $old['gallery'] = $galleryData;
}

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
                        if (isset($errors['gallery'])) {
                            $galleryErrors = $errors['gallery'];
                        }
                        else {
                            $galleryErrors = [];
                        }

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

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="<?php echo getLinkAdmin('portfolios', 'lists') ?>" class="btn btn-success">Quay lại</a>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);