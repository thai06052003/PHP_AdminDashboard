<?php
if (!defined("_INCODE")) die('Access Deined...');
// file này chứa danh sách dự án
$data = [
    'pageTitle' => 'Quản lý dự án'
];
layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);

// xử lí lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();

    // xử lí lọc người dùng
    if (!empty($body['user_id'])) {
        $userId = $body['user_id'];

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= "WHERE portfolios.user_id=$userId";
    }

    // Xử lí lọc theo từ khóa
    if (!empty($body["keyword"])) {
        $keyword = $body['keyword'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator portfolios.name LIKE '%$keyword%'";
    }
    // xử lí lọc thoe category_id
    if (!empty($body['category_id'])) {
        $categoryId = $body['category_id'];

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator portfolio_category_id=$categoryId";
    }
}

// xử lí phân trang
$allPortfolioNum = getRows("SELECT id FROM portfolios $filter");

// 1. xác định được số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE;

// 2. tính số trang
$maxPage = ceil($allPortfolioNum / $perPage);

// 3. xử lí số trang dựa vào phương thức get
if (!empty(getBody()['page'])) {
    $page = getBody()['page'];
    if ($page < 1 || $page > $maxPage) {
        $page = 1;
    }
} else {
    $page = 1;
}

// 4. truy vấn offset trong limit dựa trên biến $page
$offset = ($page - 1) * $perPage;
// truy vấn lấy tất cả bản ghi
$listAllPortfolio = getRaw("SELECT portfolios.id, portfolios.name, portfolios.create_at, portfolio_categories.name as category_name, portfolio_categories.id as category_id, users.fullname as user_name, users.id as user_id
                            FROM portfolios INNER JOIN `portfolio_categories` ON portfolios.portfolio_category_id = portfolio_categories.id
                                            INNER JOIN users ON portfolios.user_id = users.id
                            $filter 
                            ORDER BY portfolios.create_at DESC LIMIT $offset, $perPage");

// xử lí lấy danh sách người dùng
$allUser = getRaw("SELECT * FROM users ORDER BY fullname");

// truy vấn lấy danh sách danh mục
$allCategory = getRaw("SELECT id, name FROM portfolio_categories ORDER BY name");


// xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=portfolios', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&' . $queryString;
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>

<section class="content">
    <div class="container-fluid">
        <a href="<?php echo getLinkAdmin('portfolios', 'add') ?>" class="btn btn-success btn-sm mb-3">
            <i class="fas fa-plus mr-1"></i>
            Thêm dự án
        </a>
        <form action="" class="mb-3">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <select name="user_id" id="" class="form-control">
                            <option value="0">Chọn người đăng</option>
                            <?php
                            if (!empty($allUser)) {
                                foreach ($allUser as $item) {
                            ?>
                                    <option value="<?php echo $item['id'] ?>" <?php echo (!empty($userId) && $userId == $item['id']) ? 'selected' : false ?>>
                                        <?php echo $item['fullname'] . ' (' . $item['email'] . ')'; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <select name="category_id" id="" class="form-control">
                            <option value="0">Chọn danh mục</option>
                            <?php
                            if (!empty($allCategory)) :
                                foreach ($allCategory as $item) :
                            ?>
                                    <option value="<?php echo $item['id'] ?>" <?php echo (!empty($categoryId) && $categoryId == $item['id']) ? 'selected' : false ?>>
                                        <?php echo $item['name'] ?></option>

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
            <input type="hidden" name="module" value="portfolios">
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
                    <th width="15%">Danh mục</th>
                    <th width="15%">Đăng bởi</th>
                    <th width="15%">Thời gian</th>
                    <th width="10%" class="text-center">Nhân bản</th>
                    <th width="7%" class="text-center">Sửa</th>
                    <th width="8%" class="text-center">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($listAllPortfolio)) :
                    $count = 0;   // hiển thị số thứ tự
                    foreach ($listAllPortfolio as $item) :
                        $count++;

                ?>
                        <tr>
                            <td><?php echo $count + $offset + 1 ?></td>
                            <td>
                                <a href="<?php echo getLinkAdmin('portfolios', 'edit', ['id' => $item['id']]) ?>"><?php echo $item['name'] ?>
                                </a>
                            </td>
                            <td>
                                <a href="?<?php echo getLinkQueryString('category_id', $item['category_id']) ?>">
                                    <?php echo $item['category_name'] ?>
                                </a>
                            </td>
                            <td>
                                <a href="?<?php echo getLinkQueryString('user_id', $item['user_id']) ?>">
                                    <?php echo $item['user_name'] ?>
                                </a>
                            </td>
                            <td>
                                <?php echo !empty($item['create_at']) ? getDateFormat($item['create_at'], 'H:i:s d/m/Y') : false ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo getLinkAdmin('portfolios', 'duplicate', ['id' => $item['id']]) ?>" class="btn btn-danger btn-sm">Nhân bản</a>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo getLinkAdmin('portfolios', 'edit', ['id' => $item['id']]) ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo getLinkAdmin('portfolios', 'delete', ['id' => $item['id']]) ?>" onclick="return confirm('Bạn có chắc chắn hay không?')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash mr-1"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                else :
                    ?>
                    <tr>
                        <td colspan="7">
                            <div class="alert alert-dange text-center">không có dự án</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=portfolios' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
                }
                ?>
                <?php for ($index = $begin; $index <= $end; $index++) {  ?>
                    <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=portfolios' . $queryString . '&page=' . $index;  ?>"><?php echo $index;  ?></a>
                    </li>
                <?php } ?>
                <?php
                if ($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=portfolios' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</section>
<?php
layout("footer", 'admin', $data);
