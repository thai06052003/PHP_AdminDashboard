<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập Header',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

updateOptions();

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msgType);
        ?>
        <form action="" method="post">
            <h4>Thiết lập Logo - Favicon</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('header_logo', 'label') ?></label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="header_logo" placeholder="Nhập giá trị..." value="<?php echo getOption('header_logo') ?>">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <?php echo form_error('header_logo', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('header_favicon', 'label') ?></label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="header_favicon" placeholder="Nhập giá trị..." value="<?php echo getOption('header_favicon') ?>">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <?php echo form_error('header_favicon', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <h4>Thiết lập tìm kiếm</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('header_search_placehoder', 'label') ?></label>
                <input type="text" class="form-control" name="header_search_placehoder" placeholder="Nhập giá trị..." value="<?php echo getOption('header_search_placehoder') ?>">
                <?php echo form_error('header_search_placehoder', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <h4>Thiết lập khác</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('header_quote_text', 'label') ?></label>
                <input type="text" class="form-control" name="header_quote_text" placeholder="Nhập giá trị..." value="<?php echo getOption('header_quote_text') ?>">
                <?php echo form_error('header_quote_text', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('header_quote_link', 'label') ?></label>
                <input type="text" class="form-control" name="header_quote_link" placeholder="Nhập giá trị..." value="<?php echo getOption('header_quote_link') ?>">
                <?php echo form_error('header_quote_link', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);
