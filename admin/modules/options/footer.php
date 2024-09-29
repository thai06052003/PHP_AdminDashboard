<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập Footer',
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
            <h4>Thiết lập cột 1</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_1_title', 'label') ?></label>
                <input type="text" class="form-control" name="footer_1_title" placeholder="Nhập giá trị..." value="<?php echo getOption('footer_1_title') ?>">
                <?php echo form_error('footer_1_title', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_1_content', 'label') ?></label>
                <textarea class="form-control editor" name="footer_1_content" placeholder="<?php echo getOption('footer_1_content', 'label') ?>"><?php echo getOption('footer_1_content') ?></textarea>
                <?php echo form_error('footer_1_content', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <h4>Thiết lập cột 2</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_2_title', 'label') ?></label>
                <input type="text" class="form-control" name="footer_2_title" placeholder="Nhập giá trị..." value="<?php echo getOption('footer_2_title') ?>">
                <?php echo form_error('footer_2_title', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_2_content', 'label') ?></label>
                <textarea class="form-control editor" name="footer_2_content" placeholder="<?php echo getOption('footer_2_content', 'label') ?>"><?php echo getOption('footer_2_content') ?></textarea>
                <?php echo form_error('footer_2_content', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <h4>Thiết lập cột 3</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_3_title', 'label') ?></label>
                <input type="text" class="form-control" name="footer_3_title" placeholder="Nhập giá trị..." value="<?php echo getOption('footer_3_title') ?>">
                <?php echo form_error('footer_3_title', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_3_twitter', 'label') ?></label>
                <input type="text" class="form-control" name="footer_3_twitter" placeholder="Nhập giá trị..." value="<?php echo getOption('footer_3_twitter') ?>">
                <?php echo form_error('footer_3_twitter', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <h4>Thiết lập cột 4</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_4_title', 'label') ?></label>
                <input type="text" class="form-control" name="footer_4_title" placeholder="Nhập giá trị..." value="<?php echo getOption('footer_4_title') ?>">
                <?php echo form_error('footer_4_title', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_4_content', 'label') ?></label>
                <textarea class="form-control editor" name="footer_4_content" placeholder="<?php echo getOption('footer_4_content', 'label') ?>"><?php echo getOption('footer_4_content') ?></textarea>
                <?php echo form_error('footer_4_content', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <h4>Thiết lập cột 5</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_copyright', 'label') ?></label>
                <textarea class="form-control editor" name="footer_copyright" placeholder="<?php echo getOption('footer_copyright', 'label') ?>"><?php echo getOption('footer_copyright') ?></textarea>
                <?php echo form_error('footer_copyright', $errors, '<span class="error">', '</span>'); ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);
