<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập đội ngũ',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

//updateOptions();
if (isPost()) {
    $teamContent = getBody()['team-content'];
    $teamContentArr = [];

    if (!empty($teamContent['name'])) {
        foreach ($teamContent['name'] as $key => $value) {
            $teamContentArr[] = [
                'name' => $value,
                'position' => $teamContent['position'][$key],
                'image' => $teamContent['image'][$key],
                'facebook' => $teamContent['facebook'][$key],
                'twitter' => $teamContent['twitter'][$key],
                'linkedin' => $teamContent['linkedin'][$key],
                'behance' => $teamContent['behance'][$key],
            ];
        }
        $teamContentJson = json_encode($teamContentArr);
    }
    $data = [
        'team-content' => $teamContentJson
    ];
    updateOptions($data);
}


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
                <label for=""><?php echo getOption('team-title', 'label') ?></label>
                <input type="text" class="form-control" name="team-title" placeholder="<?php echo getOption('team-title', 'label') ?>" value="<?php echo getOption('team-title') ?>">
                <?php echo form_error('team-title', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <h4>Thiết lập chung</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('team-primary-title', 'label') ?></label>
                <input type="text" class="form-control" name="team-primary-title" placeholder="<?php echo getOption('team-primary-title', 'label') ?>" value="<?php echo getOption('team-primary-title') ?>">
                <?php echo form_error('team-primary-title', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('team-title-bg', 'label') ?></label>
                <input type="text" class="form-control" name="team-title-bg" placeholder="<?php echo getOption('team-title-bg', 'label') ?>" value="<?php echo getOption('team-title-bg') ?>">
                <?php echo form_error('team-title-bg', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('team-desc', 'label') ?></label>
                <textarea class="form-control editor" name="team-desc" placeholder="<?php echo getOption('team-desc', 'label') ?>"><?php echo getOption('team-desc') ?></textarea>
                <?php echo form_error('team-desc', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <!-- Team -->
            <h4>Danh sách đội ngũ</h4>
            <div class="team-wrapper">
                <?php
                $teamContentJson = getOption('team-content');
                if (!empty($teamContentJson)) {
                    $teamContentArr = json_decode($teamContentJson, true);
                    if (!empty($teamContentArr)) {
                        foreach ($teamContentArr as $item) {
                ?>
                            <!-- Team-item -->
                            <div class="team-item">
                                <div class="row">
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Tên</label>
                                                    <input type="text" class="form-control" placeholder="Tên..." name="team-content[name][]" value="<?php echo $item['name'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Chức vụ</label>
                                                    <input type="text" class="form-control" placeholder="Chức vụ..." name="team-content[position][]" value="<?php echo $item['position'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-11">
                                                            <label for="">Ảnh</label>
                                                            <div class="row ckfinder-group">
                                                                <div class="col-10">
                                                                    <input type="text" class="form-control image-render" name="team-content[image][]" placeholder="Đường dẫn ảnh..." value="<?php echo $item['image'] ?>">
                                                                </div>
                                                                <div class="col-2">
                                                                    <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-upload"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Facebook</label>
                                                    <input type="text" class="form-control" placeholder="Facebook..." name="team-content[facebook][]" value="<?php echo $item['facebook'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Twitter</label>
                                                    <input type="text" class="form-control" placeholder="Twitter..." name="team-content[twitter][]" value="<?php echo $item['twitter'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">linkedIn</label>
                                                    <input type="text" class="form-control" placeholder="linkedIn..." name="team-content[linkedin][]" value="<?php echo $item['linkedin'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Behance</label>
                                                    <input type="text" class="form-control" placeholder="Behance..." name="team-content[behance][]" value="<?php echo $item['behance'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <a href="" class="btn btn-danger btn-sm btn-block remove">x</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Team-item -->
                <?php
                        }
                    }
                }
                ?>


            </div>
            <p>
                <button type="button" class="btn btn-warning btn-sm add-team">Thêm đội ngũ</button>
            </p>
            <!-- End Team -->


            <button type="submit" class="btn btn-primary mb-3">Lưu thay đổi</button>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);
