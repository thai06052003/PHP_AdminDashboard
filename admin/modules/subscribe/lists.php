<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Đăng ký nhận tin',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

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
        $filter .= " $operator fullname LIKE '%$keyword%' OR email LIKE '%$keyword%'";
    }
}

// xử lí phân trang

// 1. lấy số lượng bản ghi trang
$allSubscribeNum = getRows("SELECT id FROM subscribe $filter");

// 2. số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE;

// 3. tính số trang
$maxPage = ceil($allSubscribeNum / $perPage);    // làm tròn lên

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
$listSubscribe = getRaw("SELECT *
                    FROM subscribe
                    $filter 
                    ORDER BY create_at DESC LIMIT $offset, $perPage");
/* echo '<pre>';
print_r($listSubscribe);
echo '</pre>'; */

// xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=subscribe', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&' . $queryString;
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>

<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="" method="get">
            <div class="row mb-3">
                <div class="col-9">
                    <input type="search" name="keyword" class="form-control" placeholder="Nhập từ khóa tìm kiếm..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="subscribe"> <!-- ngăn chuyển về trang chủ -->
        </form>
        <?php
        getMsg($msg, $msgType);
        ?>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th width="10%">Thời gian</th>
                    <th width="10%">Trạng thái</th>
                    <th width="10%" class="text-center">Sửa</th>
                    <th width="10%" class="text-center">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listSubscribe)) :
                    foreach ($listSubscribe as $key => $item) :
                ?>
                        <tr>
                            <td><?php echo $key + $offset + 1 ?></td>
                            <td>
                                <?php echo $item['fullname']; ?>
                            </td>
                            <td>
                                <?php echo $item['email']; ?>
                            <td>
                                <?php echo getDateFormat($item['create_at'], 'H:i:s d/m/Y'); ?>
                            </td>
                            <td>
                                <?php echo $item['status'] == 0 ? '<button class="btn btn-warning btn-sm">Chưa xử lý</button>' : '<button class="btn btn-success btn-sm">Đã xử lý</button>'; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo getLinkAdmin('subscribe', 'edit', ['id' => $item['id']]) ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo getLinkAdmin('subscribe', 'delete', ['id' => $item['id']]) ?>" onclick="confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">
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
                        <td colspan="6" class="text-center">Không có đăng ký</td>
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
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=subscribe' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
                }
                ?>
                <?php for ($index = $begin; $index <= $end; $index++) {  ?>
                    <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=subscribe' . $queryString . '&page=' . $index;  ?>"><?php echo $index;  ?></a></li>
                <?php } ?>
                <?php
                if ($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=subscribe' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<?php
layout("footer", 'admin', $data);
