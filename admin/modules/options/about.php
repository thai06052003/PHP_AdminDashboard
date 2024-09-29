<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập giới thiệu',
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
                <label for=""><?php echo getOption('about-title', 'label') ?></label>
                <input type="text" class="form-control" name="about-title" placeholder="<?php echo getOption('about-title', 'label') ?>" value="<?php echo getOption('about-title') ?>">
                <?php echo form_error('about-title', $errors, '<span class="error">', '</span>'); ?>
            </div>
            
            <button type="submit" class="btn btn-primary mb-3">Lưu thay đổi</button>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);