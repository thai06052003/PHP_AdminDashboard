<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập menu',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

if (isPost()) {
    $body = getBody();

    if (isset($body['menu'])) {
        $dataUpdate = ['menu' => $body['menu']];
        updateOptions($dataUpdate);
    }
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
        <form action="" method="post" id="frmEdit">
            <div class="row">
                <div class="col-6">
                    <ul id="myEditor" class="sortableLists list-group"></ul>
                </div>
                <div class="col-6">
                    <div class="card border-primary mb-3">
                        <div class="card-header bg-primary text-white">Quản lý</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="text">Tiêu đề</label>
                                <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Tiêu đề...">
                            </div>
                            <div class="form-group">
                                <label for="href">Link</label>
                                <input type="text" class="form-control item-menu" id="href" name="href" placeholder="Link...">
                            </div>
                            <div class="form-group">
                                <label for="target">Target</label>
                                <select name="target" id="target" class="form-control item-menu">
                                    <option value="_self">Self</option>
                                    <option value="_blank">Blank</option>
                                    <option value="_top">Top</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Tooltip</label>
                                <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip...">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Cập nhật</button>
                            <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Thêm mới</button>
                        </div>
                    </div>
                </div>
            </div>
            <textarea name="menu" id="menu-content" style="display:none"></textarea>
            <button type="submit" class="save-menu btn btn-primary my-3">Lưu menu</button>
        </form>
    </div>
</section>
<script type="text/javascript">
    <?php $menuJson =  !empty(getOption('menu')) ? html_entity_decode(getOption('menu')) : false;?>
    var arrayJson = <?php echo $menuJson ?>;
</script>
<?php
layout("footer", 'admin', $data);
