<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh sách liên hệ',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// xử lí lọc dữ liệu
$filter = '';

if (isGet()) {
    $body = getBody();
    // xử lí lọc status
    if (!empty($body['status'])) {
        $status = $body['status'];

        if ($status == 2) {
            $statusSql = 0;
        } else {
            $statusSql = $status;
        }

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= "WHERE status=$statusSql";
    }

    // Xử lí lọc theo từ khóa
    if (!empty($body["keyword"])) {
        $keyword = $body['keyword'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator (message LIKE '%$keyword%' OR fullname LIKE '%$keyword%' OR email LIKE '%$keyword%')";
    }
    // xử lý lọc theo phòng ban
    if (!empty($body["type_id"])) {
        $typeId = $body['type_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator contacts.type_id=$typeId";
    }
}

// xử lí phân contact

// 1. lấy số lượng bản ghi contacts
$allContactNum = getRows("SELECT id FROM `contacts` $filter");

// 2. số lượng bản ghi trên 1 contacts
$perPage = _PER_PAGE;

// 3. tính số contacts
$maxPage = ceil($allContactNum / $perPage);    // làm tròn lên

// 4. xử lí số contacts dựa vào phương thức get
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
$listContact = getRaw("SELECT contacts.id, contacts.fullname, contacts.create_at, email, message, status, note, contact_type.name as type_name, contacts.type_id
                    FROM contacts INNER JOIN contact_type ON contacts.type_id = contact_type.id
                    $filter 
                    ORDER BY contacts.create_at DESC LIMIT $offset, $perPage");
/* echo '<pre>';
print_r($listContact);
echo '</pre>'; */

// xử lý query string tìm kiếm với phân contacts
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=contacts', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&' . $queryString;
}

// Lấy dữ liệu tất cả phòng ban
$allContactType = getRaw("SELECT id, name FROM contact_type ORDER BY name");

/* echo '<pre>';
print_r($allContactType);
echo '</pre>'; */


$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>

<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="" method="get">
            <div class="row mb-3">
                <div class="col-3">
                    <div class="form-group">
                        <select name="status" id="" class="form-control">
                            <option value="0">Chọn trạng thái</option>
                            <option value="1" <?php echo (!empty($status) && $status == 1) ? 'selected' : false ?>>Đã xử lý</option>
                            <option value="2" <?php echo (!empty($status) && $status == 2) ? 'selected' : false ?>>Chưa xử lý</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <select name="type_id" id="" class="form-control">
                        <option value="0">Chọn phòng ban</option>
                        <?php
                        if (!empty($allContactType)) :
                            foreach ($allContactType as $item) :
                        ?>
                                <option value="<?php echo $item['id'] ?>" <?php echo (!empty($typeId)) && $typeId == $item['id'] ? 'selected' : false; ?>><?php echo $item['name'] ?></option>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>

                <div class="col-4">
                    <input type="search" name="keyword" class="form-control" placeholder="Nhập tên từ khóa tìm kiếm..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="contacts"> <!-- ngăn chuyển về contacts chủ -->
        </form>
        <?php
        getMsg($msg, $msgType);
        ?>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th width="15%">Thông tin</th>
                    <th>Nội dung</th>
                    <th>Ghi chú</th>
                    <th width="10%" class="text-center">Trạng thái</th>
                    <th width="10%">Thời gian</th>
                    <th width="10%" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listContact)) :
                    foreach ($listContact as $key => $item) :
                ?>
                        <tr>
                            <td><?php echo $key + $offset + 1 ?></td>
                            <td>
                                Họ tên: <?php echo $item['fullname']; ?> <br>
                                Email: <?php echo $item['email']; ?> <br>
                                Phòng ban: <?php echo $item['type_name']; ?>
                            </td>
                            <td>
                                <?php echo $item['message']; ?>
                            </td>
                            <td>
                                <?php echo $item['note']; ?>
                            </td>
                            <td class="text-center">
                                <?php
                                if ($item['status'] == 1) echo '<button class="btn btn-primary btn-sm">Đang xử lý</button>';
                                else if ($item['status'] == 2) echo '<button class="btn btn-success btn-sm">Đã xử lý</button>';
                                else echo '<button class="btn btn-warning btn-sm">Chưa xử lý</button>';
                                ?>
                            </td>
                            <td>
                                <?php echo getDateFormat($item['create_at'], 'H:i:s d/m/Y'); ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo getLinkAdmin('contacts', 'duplicate', ['id' => $item['id']]) ?>" class="btn btn-secondary btn-sm ">Nhân bản</a>
                                <br>
                                <a href="<?php echo getLinkAdmin('contacts', 'edit', ['id' => $item['id']]) ?>" class="btn btn-warning btn-sm my-2">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <br>
                                <a href="<?php echo getLinkAdmin('contacts', 'delete', ['id' => $item['id']]) ?>" onclick="confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm ">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                else :
                    ?>

                    <tr>
                        <td colspan="8" class="text-center">Không có liên hệ</td>
                    </tr>

                <?php endif; ?>
            </tbody>
        </table>
        <!-- Phân contacts -->
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
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contacts' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
                }
                ?>
                <?php for ($index = $begin; $index <= $end; $index++) {  ?>
                    <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=contacts' . $queryString . '&page=' . $index;  ?>"><?php echo $index;  ?></a></li>
                <?php } ?>
                <?php
                if ($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contacts' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<?php
layout("footer", 'admin', $data);
