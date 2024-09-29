<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập dịch vụ',
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
                <label for=""><?php echo getOption('service-title', 'label') ?></label>
                <input type="text" class="form-control" name="service-title" placeholder="<?php echo getOption('service-title', 'label') ?>" value="<?php echo getOption('service-title') ?>">
                <?php echo form_error('service-title', $errors, '<span class="error">', '</span>'); ?>
            </div>
            
            <button type="submit" class="btn btn-primary mb-3">Lưu thay đổi</button>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);