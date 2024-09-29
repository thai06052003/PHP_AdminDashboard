<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập liên hệ',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

//updateOptions();
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
                <label for=""><?php echo getOption('contact-title', 'label') ?></label>
                <input type="text" class="form-control" name="contact-title" placeholder="<?php echo getOption('contact-title', 'label') ?>" value="<?php echo getOption('contact-title') ?>">
                <?php echo form_error('contact-title', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('contact-primary-title', 'label') ?></label>
                <input type="text" class="form-control" name="contact-primary-title" placeholder="<?php echo getOption('contact-primary-title', 'label') ?>" value="<?php echo getOption('contact-primary-title') ?>">
                <?php echo form_error('contact-primary-title', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <h4>Thiết lập chung</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('contact-title-bg', 'label') ?></label>
                <input type="text" class="form-control" name="contact-title-bg" placeholder="<?php echo getOption('contact-title-bg', 'label') ?>" value="<?php echo getOption('contact-title-bg') ?>">
                <?php echo form_error('contact-title-bg', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('contact-desc', 'label') ?></label>
                <textarea class="form-control editor" name="contact-desc" placeholder="<?php echo getOption('contact-desc', 'label') ?>"><?php echo getOption('contact-desc') ?></textarea>
                <?php echo form_error('contact-desc', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <button type="submit" class="btn btn-primary mb-3">Lưu thay đổi</button>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);
