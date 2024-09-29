<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
// file này chứa danh sách người dùng

$data = [
    'pageTitle' => 'Quản lý người dùng'
];
layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userId = islogin()['user_id'];     // lấy userId đang đặp nhập

// xử lí lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();
    
    // xử lí lọc status
    if (!empty($body['status'])) {
        $status = $body['status'];
        
        if ($status == 2) {
            $statusSql = 0;
        }
        else {
            $statusSql = $status;
        }

        if (!empty($filter) && strpos($filter, 'WHERE') >=0) {
            $operator = 'AND';
        }
        else {
            $operator = 'WHERE';
        }

        $filter .= "WHERE status=$statusSql";
    }

    // Xử lí lọc theo từ khóa
    if (!empty( $body["keyword"])) {
        $keyword = $body['keyword'];
        if (!empty($filter) && strpos($filter, 'WHERE') >=0) {
            $operator = 'AND';
        }
        else {
            $operator = 'WHERE';
        }
        $filter .= " $operator fullname LIKE '%$keyword%'";
    }
    // xử lí lọc thoe group
    if (!empty($body['group_id'])) {
        $groupId = $body['group_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >=0) {
            $operator = 'AND';
        }
        else {
            $operator = 'WHERE';
        }
        $filter .= " $operator group_id=$groupId";
    }
    echo $filter;
}

// xử lí phân trang
$allUserNum = getRows("SELECT id FROM users $filter");

// 1. xác định được số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE;

// 2. tính số trang
$maxPage = ceil($allUserNum / $perPage);

// 3. xử lí số trang dựa vào phương thức get
if (!empty(getBody()['page'])) {
    $page = getBody()['page'];
    if ($page < 1 || $page > $maxPage) {
        $page = 1;
    }
}
else {
    $page = 1;
}

// 4. truy vấn offset trong limit dựa trên biến $page
$offset = ($page-1) * $perPage;
// truy vấn lấy tất cả bản ghi
$listAllUser = getRaw("SELECT users.id, fullname, email, status, users.create_at, groups.name as group_name FROM users INNER JOIN `groups` ON users.group_id = groups.id  $filter ORDER BY users.create_at DESC LIMIT $offset, $perPage");

// truy vấn lấy danh sách nhóm
$allgroup = getRaw("SELECT id, name FROM groups ORDER BY name");


// xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=users','', $queryString);
    $queryString = str_replace('&page='.$page,'', $queryString);
    $queryString = trim($queryString,'&');
    $queryString = '&'.$queryString;
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>

<section class="content">
    <div class="container-fluid">
        <a href="<?php echo getLinkAdmin('users', 'add') ?>" class="btn btn-success btn-sm mb-3">
            <i class="fas fa-user-plus mr-1"></i>
            Thêm người dùng
        </a>
        <form action="" class="mb-3">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <select name="status" id="" class="form-control">
                            <option value="0">Chọn trạng thái</option>
                            <option value="1" <?php echo (!empty($status) && $status == 1) ? 'selected' : false ?>>Kích hoạt</option>
                            <option value="2" <?php echo (!empty($status) && $status == 2) ? 'selected' : false ?>>Chưa kích hoạt</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <select name="group_id" id="" class="form-control">
                            <option value="0">Chọn nhóm</option>
                            <?php
                            if (!empty($allgroup)):
                                foreach($allgroup as $item):
                            ?>
                            <option value="<?php echo $item['id']?>" <?php echo (!empty($groupId) && $groupId == $item['id']) ? 'selected' : false ?>><?php echo $item['name']?></option>

                            <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <input type="search" name="keyword" class="form-control" placeholder="Tìm kiếm..." value="<?php echo (!empty($keyword)) ? $keyword : false ?>">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="users">
        </form>
        <?php
            getMsg($msg, $msgType);
        ?>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Nhóm</th>
                    <th width="15%">Thời gian</th>
                    <th width="15%" class="text-center">Trạng thái</th>
                    <th width="7%" class="text-center">Sửa</th>
                    <th width="8%" class="text-center">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ( ! empty( $listAllUser ) ):
                    $count = 0;   // hiển thị số thứ tự
                    foreach ( $listAllUser as $item ):
                        $count++;
                
                ?>
                <tr>
                    <td><?php echo $count + $offset + 1 ?></td>
                    <td>
                        <a href="<?php echo getLinkAdmin('users', 'edit', ['id'=>$item['id']]) ?>"><?php echo $item['fullname'] ?></a>
                    </td>
                    <td><?php echo $item['email'] ?></td>
                    <td><?php echo $item['group_name'] ?></td>
                    <td><?php echo !empty($item['create_at']) ? getDateFormat($item['create_at'], 'H:i:s d/m/Y') : false ?></td>
                    <td class="text-center"><?php echo $item['status'] == 1 ? '<button class="btn btn-primary btn-sm">Kích hoạt</button>' : '<button class="btn btn-warning btn-sm">Chưa kích hoạt</button>' ?></td>
                    <td class="text-center">
                        <a href="<?php echo getLinkAdmin('users', 'edit', ['id'=>$item['id']]) ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit mr-1"></i> 
                            Edit
                        </a>
                    </td>
                    <td class="text-center">
                        <?php if ($item['id'] != $userId): ?>
                        <a href="<?php echo getLinkAdmin('users', 'delete', ['id'=>$item['id']]) ?>" onclick="return confirm('Bạn có chắc chắn hay không?')" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash mr-1"></i>
                            Delete
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="7">
                        <div class="alert alert-dange text-center">không có người dùng</div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example" class="d-flex justify-content-end">
            <ul class="pagination pagination-sm">
                <?php
                $begin = $page -2;
                if ( $begin < 1) {
                    $begin = 1;
                }
                $end = $page + 2;
                if ($end > $maxPage ) {
                    $end = $maxPage;
                }
                if ($page >1) {
                    $prevPage = $page-1;
                    echo '<li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT_ADMIN.'?module=users'.$queryString.'&page='.$prevPage.'">Trước</a></li>';
                }
                ?>
                <?php for ($index =$begin; $index <= $end; $index++) {  ?>
                <li class="page-item <?php echo ($index==$page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=users'.$queryString.'&page='.$index;  ?>"><?php echo $index;  ?></a></li>
                <?php } ?>
                <?php
                    if ($page < $maxPage) {
                        $nextPage = $page+1;
                        echo '<li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT_ADMIN.'?module=users'.$queryString.'&page='.$nextPage.'">Sau</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </div>
</section>
<?php
layout("footer", 'admin', $data);