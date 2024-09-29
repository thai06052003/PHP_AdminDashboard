<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập chung',
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
            <h4>Thông tin chung</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('general_sitename', 'label') ?></label>
                <input type="text" class="form-control" name="general_sitename" placeholder="<?php echo getOption('general_sitename', 'label') ?>" value="<?php echo getOption('general_sitename') ?>">
                <?php echo form_error('general_sitename', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_sitedesc', 'label') ?></label>
                <textarea class="form-control editor" name="general_sitedesc" placeholder="<?php echo getOption('general_sitedesc', 'label') ?>"><?php echo getOption('general_sitedesc') ?></textarea>
                <?php echo form_error('general_sitedesc', $errors, '<span class="error">', '</span>'); ?>
            </div>
            
            <h4>Thông tin liên hệ</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('general_hotline', 'label') ?></label>
                <input type="text" class="form-control" name="general_hotline" placeholder="Nhập giá trị..." value="<?php echo getOption('general_hotline') ?>">
                <?php echo form_error('general_hotline', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_email', 'label') ?></label>
                <input type="text" class="form-control" name="general_email" placeholder="Email..." value="<?php echo getOption('general_email') ?>">
                <?php echo form_error('general_email', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_time', 'label') ?></label>
                <input type="text" class="form-control" name="general_time" placeholder="Thời gian làm việc..." value="<?php echo getOption('general_time') ?>">
                <?php echo form_error('general_time', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_address', 'label') ?></label>
                <input type="text" class="form-control" name="general_address" placeholder="<?php echo getOption('general_address', 'label') ?>" value="<?php echo getOption('general_address') ?>">
                <?php echo form_error('general_address', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_facebook', 'label') ?></label>
                <input type="text" class="form-control" name="general_facebook" placeholder="Thời gian làm việc..." value="<?php echo getOption('general_facebook') ?>">
                <?php echo form_error('general_facebook', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_twitter', 'label') ?></label>
                <input type="text" class="form-control" name="general_twitter" placeholder="Thời gian làm việc..." value="<?php echo getOption('general_twitter') ?>">
                <?php echo form_error('general_twitter', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_linkedin', 'label') ?></label>
                <input type="text" class="form-control" name="general_linkedin" placeholder="Thời gian làm việc..." value="<?php echo getOption('general_linkedin') ?>">
                <?php echo form_error('general_linkedin', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_behance', 'label') ?></label>
                <input type="text" class="form-control" name="general_behance" placeholder="Thời gian làm việc..." value="<?php echo getOption('general_behance') ?>">
                <?php echo form_error('general_behance', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_youtube', 'label') ?></label>
                <input type="text" class="form-control" name="general_youtube" placeholder="Thời gian làm việc..." value="<?php echo getOption('general_youtube') ?>">
                <?php echo form_error('general_youtube', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Lưu thay đổi</button>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);