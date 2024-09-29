<?php

use Symfony\Component\VarDumper\VarDumper;

if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh sách trang',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if (!$checkPermission) {
    redirectPermission();
}
$checkRoleAdd = checkCurrentPermission('add');
$checkRoleEdit = checkCurrentPermission('edit');
$checkRoleDelete = checkCurrentPermission('delete');
$checkRoleDuplicate = checkCurrentPermission('duplicate');

// xử lí lọc dữ liệu
$filter = '';

if (isGet()) {
    $body = getBody();
    // Xử lí lọc theo từ khóa
    if (!empty($body["keyword"])) {
        $keyword = $body['keyword'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator title LIKE '%$keyword%'";
    }

    // xử lý lọc theo user
    if (!empty($body["user_id"])) {
        $userId = $body['user_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator user_id=$userId";
    }
}

// xử lí phân trang

// 1. lấy số lượng bản ghi trang
$allpagesNum = getRows("SELECT id FROM `pages` $filter");

// 2. số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE;

// 3. tính số trang
$maxPage = ceil($allpagesNum / $perPage);    // làm tròn lên

// 4. xử lí số trang dựa vào phương thức get
if (!empty(getBody()['page'])) {
    $page = getBody()['page'];
    if ($page < 1 || $page > $maxPage) {
        $page = 1;
    }
} else {
    $page = 1;
}

// 5. truy vấn offset trong limit dựa trên biến $page
$offset = ($page - 1) * $perPage;

// lấy dữ liệu nhóm người dùng
$listPages = getRaw("SELECT pages.id,  pages.title, pages.create_at, fullname, users.id as user_id FROM pages INNER JOIN users ON pages.user_id = users.id $filter ORDER BY pages.create_at DESC LIMIT $offset, $perPage");
/* echo '<pre>';
print_r($listPages);
echo '</pre>'; */

// xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=pages', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&' . $queryString;
}

// Lấy dữ liệu tất cả người dùng
$allUsers = getRaw("SELECT id, fullname, email FROM users ORDER BY fullname");
/* echo '<pre>';
print_r($allUsers);
echo '</pre>';
 */

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>

<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php if ($checkRoleAdd): ?>
        <a href="<?php echo getLinkAdmin('pages', 'add') ?>" class="btn btn-success btn-sm mb-3">
            <i class="fas fa-plus"></i>
            Thêm trang
        </a>
        <?php endif; ?>
        <form action="" method="get">
            <div class="row mb-3">
                <div class="col-3">
                    <select name="user_id" id="" class="form-control">
                        <option value="0">Chọn người đăng</option>
                        <?php
                        if (!empty($allUsers)) :
                            foreach ($allUsers as $item) :
                        ?>
                                <option value="<?php echo $item['id'] ?>" <?php echo (!empty($userId) && $userId == $item['id'] ? 'selected' : false) ?>><?php echo $item['fullname'] . ' (' . $item['email'] . ')' ?></option>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="col-6">
                    <input type="search" name="keyword" class="form-control" placeholder="Nhập tên trang..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="pages"> <!-- ngăn chuyển về trang chủ -->
        </form>
        <?php
        getMsg($msg, $msgType);
        ?>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Tiêu đề</th>
                    <th width="15%">Đăng bởi</th>
                    <th width="10%">Thời gian</th>
                    <th width="10%" class="text-center">Xem</th>
                    <?php
                    if ($checkRoleDuplicate){
                        echo '<th width="10%" class="text-center">Nhân bản</th>';
                    }
                    if ($checkRoleEdit){
                        echo '<th width="10%" class="text-center">Sửa</th>';
                    }
                    if ($checkRoleDelete){
                        echo '<th width="10%" class="text-center">Xóa</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listPages)) :
                    foreach ($listPages as $key => $item) :
                ?>
                        <tr>
                            <td><?php echo $key + $offset + 1 ?></td>
                            <td>
                                <a href="<?php echo getLinkAdmin('pages', 'edit', ['id' => $item['id']]) ?>">
                                    <?php echo $item['title']; ?>
                                </a>
                            </td>
                            <td>
                                <a href="?<?php echo getLinkQueryString('user_id', $item['user_id']); ?>">
                                    <?php echo $item['fullname']; ?>
                                </a>
                            </td>

                            <td>
                                <?php echo getDateFormat($item['create_at'], 'H:i:s d/m/Y'); ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo getLinkModule('pages', $item['id']) ?>" target="_blank" class="btn btn-primary btn-sm">Xem</a>
                            </td>
                            <?php if ($checkRoleDuplicate): ?>
                            <td class="text-center">
                                <a href="<?php echo getLinkAdmin('pages', 'duplicate', ['id' => $item['id']]) ?>" class="btn btn-danger btn-sm">Nhân bản</a>
                            </td>
                            <?php
                            endif;
                            if ($checkRoleEdit): 
                            ?>
                            <td class="text-center">
                                <a href="<?php echo getLinkAdmin('pages', 'edit', ['id' => $item['id']]) ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                            </td>
                            <?php 
                            endif; 
                            if ($checkRoleDelete):
                            ?>
                            <td class="text-center">
                                <a href="<?php echo getLinkAdmin('pages', 'delete', ['id' => $item['id']]) ?>" onclick="confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php
                    endforeach;
                else :
                    ?>

                    <tr>
                        <td colspan="8" class="text-center">Không có trang</td>
                    </tr>

                <?php endif; ?>
            </tbody>
        </table>
        <!-- Phân trang -->
        <nav aria-label="Page navigation example" class="d-flex justify-content-end">
            <ul class="pagination pagination-sm">
                <?php
                $begin = $page - 2;
                if ($begin < 1) {
                    $begin = 1;
                }
                $end = $page + 2;
                if ($end > $maxPage) {
                    $end = $maxPage;
                }
                if ($page > 1) {
                    $prevPage = $page - 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=pages' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
                }
                ?>
                <?php for ($index = $begin; $index <= $end; $index++) {  ?>
                    <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=pages' . $queryString . '&page=' . $index;  ?>"><?php echo $index;  ?></a></li>
                <?php } ?>
                <?php
                if ($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=pages' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<?php
layout("footer", 'admin', $data);
