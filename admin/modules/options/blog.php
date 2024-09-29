<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => getOption('blog-title'),
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
            <h4>Thiết lập tiêu đề</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('blog-title', 'label') ?></label>
                <input type="text" class="form-control" name="blog-title" placeholder="<?php echo getOption('blog-title', 'label') ?>" value="<?php echo getOption('blog-title') ?>">
                <?php echo form_error('blog-title', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <h4>Thiết lập bài viết</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('blog-per-page', 'label') ?></label>
                <input type="number" min="1" class="form-control" name="blog-per-page" placeholder="<?php echo getOption('blog-per-page', 'label') ?>" value="<?php echo getOption('blog-per-page') ?>">
                <?php echo form_error('blog-per-page', $errors, '<span class="error">', '</span>'); ?>
            </div>
            
            <button type="submit" class="btn btn-primary mb-3">Lưu thay đổi</button>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);