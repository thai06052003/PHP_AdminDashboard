<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh mục dự án',
];

layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

$filter = "";
$view = 'add';   // mặc định;
$id = 0;    // id mặc định
// xử lí lọc dữ liệu
//if (isGet()) {
$body = getBody('get');

if (!empty($body["keyword"])) {
    $keyword = $body['keyword'];
    $filter = "WHERE name LIKE '%$keyword%'";
}

if (!empty($body['view'])) {
    $view = $body['view'];
}

if (!empty($body['id'])) {
    $id = $body['id'];
}
//}

// xử lí phân trang

// 1. lấy số lượng bản ghi danh mục dự án
$allCategoryNum = getRows("SELECT id FROM `portfolio_categories` $filter");

// 2. số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE;

// 3. tính số trang
$maxPage = ceil($allCategoryNum / $perPage);    // làm tròn lên

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
$listCategory = getRaw("SELECT *, (SELECT count(portfolios.id) FROM portfolios WHERE portfolios.portfolio_category_id = portfolio_categories.id) as portfolios_count FROM `portfolio_categories` $filter ORDER BY create_at DESC LIMIT $offset, $perPage");

// xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=users', '', $queryString);
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
        <?php
        getMsg($msg, $msgType);
        ?>
        <div class="row">
            <div class="col-6">
                <?php
                if (!empty($view) && !empty(($id))) {
                    require_once $view . '.php';
                } else {
                    require 'add.php';
                }
                ?>
            </div>
            <div class="col-6">
                <h4>Danh sách danh mục</h4>
                <form action="" method="get">
                    <div class="row mb-3">
                        <div class="col-9">
                            <input type="search" name="keyword" class="form-control" placeholder="Nhập tên danh mục..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                        </div>
                    </div>
                    <input type="hidden" name="module" value="portfolio_categories"> <!-- ngăn chuyển về trang chủ -->
                </form>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">STT</th>
                            <th>Tên</th>
                            <th width="20%">Thời gian</th>
                            <th width="18%" class="text-center">Nhân bản</th>
                            <th width="7%" class="text-center">Sửa</th>
                            <th width="8%" class="text-center">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($listCategory)) :
                            foreach ($listCategory as $key => $item) :
                        ?>
                                <tr>
                                    <td><?php echo $key + $offset + 1 ?></td>
                                    <td>
                                        <a href="<?php echo getLinkAdmin('portfolio_categories', '', ['id' => $item['id'], 'view' => 'edit']) ?>">
                                            <?php echo $item['name']; ?>
                                        </a>
                                        <?php echo ' (' . $item['portfolios_count'] . ')'; ?>
                                    </td>
                                    <td>
                                        <?php echo !empty($item['create_at']) ? getDateFormat($item['create_at'], 'H:i:s d/m/Y') : ''; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo getLinkAdmin('portfolio_categories', 'duplicate', ['id' => $item['id']]) ?>" class="btn btn-danger btn-sm">Nhân bản</a>
                                    </td>
                                    <td>
                                        <a href="<?php echo getLinkAdmin('portfolio_categories', '', ['id' => $item['id'], 'view' => 'edit']) ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php echo getLinkAdmin('portfolio_categories', 'delete', ['id' => $item['id']]) ?>" onclick="confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                        else :
                            ?>

                            <tr>
                                <td colspan="5" class="text-center">Không có danh mục dự án</td>
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
                            echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=portfolio_categories' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
                        }
                        ?>
                        <?php for ($index = $begin; $index <= $end; $index++) {  ?>
                            <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=portfolio_categories' . $queryString . '&page=' . $index;  ?>"><?php echo $index;  ?></a></li>
                        <?php } ?>
                        <?php
                        if ($page < $maxPage) {
                            $nextPage = $page + 1;
                            echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=portfolio_categories' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<?php
layout("footer", 'admin', $data);
