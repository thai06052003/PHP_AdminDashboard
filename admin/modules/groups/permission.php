<?php
if (!defined('_INCODE')) die('Access Deined...');

// lấy dữ liệu cũ của nhóm người dùng
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])) {
    $groupId = $body['id'];

    $groupDetail = firstRaw("SELECT * FROM `groups` WHERE id='$groupId'");
    if (empty($groupDetail)) {
        //Không Tồn tại
        redirect('admin?module=groups');
    }
} else {
    redirect('admin?module=groups');
}

$data = [
    'pageTitle' => 'Phân quyền nhóm người dùng: ' . $groupDetail['name'],
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);




// xử lí cập nhật nhóm người dùng
if (isPost()) {
    $body = getBody();  // lấy tất cả dữ liệu trong form
    $errors = [];   // mảng lưu trữu lỗi

    if (empty($errors)) {
        if (!empty($body['permissions'])) {
            $permissionJson = json_encode($body['permissions']);
        } else {
            $permissionJson = '';
        }

        $dataUpdate =  [
            'permission'=> trim($permissionJson),
            'update_at' => date('Y-m-d H:i:s'),
        ];

        $condition = "id=$groupId";
        $updateStatus = update('groups', $dataUpdate, $condition);
        if ($updateStatus) { 
            setFlashData('msg', 'Cập nhật phân quyền người dùng thành công');
            setFlashData('msg_type', 'success');
        }
        else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    }else {
        // có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
    }
    // load lại trang sửa hiện tại
    redirect('admin?module=groups&action=permission&id='.$groupId);
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($groupDetail)) {
    $old = $groupDetail;
}

// lấy danh sách module
$moduleList = getRaw("SELECT * FROM modules");
/* echo '<pre>';
print_r($moduleList);
echo '</pre>'; */
if (!empty($old['permission'])) {
    $permissionJson = $old['permission'];
    $permissionArr = json_decode($permissionJson, true);
}

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msgType);
        ?>
        <form action="" method="post">

            <table class="table table-bordered permission-lists">
                <thead>
                    <tr>
                        <th width="25%">Module</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($moduleList)) :
                        foreach ($moduleList as $item) :
                            $action = $item['action'];
                            $actionArr = json_decode($action, true);
                    ?>
                            <tr>
                                <td><strong><?php echo $item['title'] ?></strong></td>
                                <td>
                                    <div class="row">
                                        <?php
                                        if (!empty($actionArr)) :
                                            foreach ($actionArr as $roleKey => $roleTitle) :
                                        ?>
                                        <div class="col-3 mb-1">
                                            <input type="checkbox" name="<?php echo 'permissions[' . $item['name'] . '][]' ?>" value="<?php echo $roleKey ?>" id="<?php echo $item['name'] . '_' . $roleKey ?>" <?php echo (!empty($permissionArr[$item['name']]) && in_array($roleKey, $permissionArr[$item['name']])) ? 'checked' : false ?>>
                                            <label for="<?php echo $item['name'] . '_' . $roleTitle ?>"><?php echo $roleTitle ?></label>
                                        </div>
                                        <?php endforeach;
                                        endif; ?>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
            
            <button type="submit" class="btn btn-primary mb-3">Phân quyền</button>
            <a href="<?php echo getLinkAdmin('groups', 'lists') ?>" class="btn btn-success mb-3">Quay lại</a>
        </form>
    </div>
</section>

<?php
layout("footer", 'admin', $data);
