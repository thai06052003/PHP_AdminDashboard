<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh sách bài viết',
];
layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);
layout('breadcrumb', 'admin', $data);
// xử lí lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();
    // Xử lí lọc theo từ khóa
    if (!empty( $body["keyword"])) {
        $keyword = $body['keyword'];
        if (!empty($filter) && strpos($filter, 'WHERE') >=0) {
            $operator = 'AND';
        }
        else {
            $operator = 'WHERE';
        }
        $filter .= " $operator (title LIKE '%$keyword%' OR content LIKE '%$keyword%')";
    }

    // xử lý lọc theo user
    if (!empty( $body["user_id"])) {
        $userId = $body['user_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >=0) {
            $operator = 'AND';
        }
        else {
            $operator = 'WHERE';
        }
        $filter .= " $operator blog.user_id=$userId";
    }

    // xử lý lọc theo chuyên mục
    if (!empty( $body["category_id"])) {
        $categoryId = $body['category_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >=0) {
            $operator = 'AND';
        }
        else {
            $operator = 'WHERE';
        }
        $filter .= " $operator blog.category_id=$categoryId";
    }
}

// xử lí phân blog

// 1. lấy số lượng bản ghi blog
$allBlogNum = getRows("SELECT id FROM `blog` $filter");

// 2. số lượng bản ghi trên 1 blog
$perPage = _PER_PAGE;

// 3. tính số blog
$maxPage = ceil($allBlogNum / $perPage);    // làm tròn lên

// 4. xử lí số blog dựa vào phương thức get
if (!empty(getBody()['page'])) {
    $page = getBody()['page'];
    if ($page < 1 || $page > $maxPage) {
        $page = 1;
    }
}
else {
    $page = 1;
}

// 5. truy vấn offset trong limit dựa trên biến $page
$offset = ($page-1) * $perPage;

// lấy dữ liệu nhóm người dùng
$listBlog = getRaw("SELECT blog.id,  blog.title, blog.create_at, fullname, users.id as user_id, view_count, blog_categories.name as category_name, category_id
                    FROM blog INNER JOIN users ON blog.user_id = users.id 
                              INNER JOIN blog_categories ON blog.category_id = blog_categories.id
                    $filter 
                    ORDER BY blog.create_at DESC LIMIT $offset, $perPage");
/* echo '<pre>';
print_r($listBlog);
echo '</pre>'; */

// xử lý query string tìm kiếm với phân blog
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=blog','', $queryString);
    $queryString = str_replace('&page='.$page,'', $queryString);
    $queryString = trim($queryString,'&');
    $queryString = '&'.$queryString;
}

// Lấy dữ liệu tất cả người dùng
$allUsers = getRaw("SELECT id, fullname, email FROM users ORDER BY fullname");
// Lấy dữ liệu tất cả chuyên mục
$allCategories = getRaw("SELECT id, name FROM blog_categories ORDER BY name");

/* echo '<pre>';
print_r($allCategories);
echo '</pre>'; */

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <a href="<?php echo getLinkAdmin('blog', 'add') ?>" class="btn btn-success btn-sm mb-3">
            <i class="fas fa-plus"></i>
            Thêm bài viết
        </a>
    <form action="" method="get">
        <div class="row mb-3">
            <div class="col-3">
                <select name="user_id" id="" class="form-control">
                    <option value="0">Chọn người đăng</option>
                    <?php
                    if (!empty($allUsers)):
                        foreach ($allUsers as $item):
                    ?>
                            <option value="<?php echo $item['id'] ?>" <?php echo (!empty($userId) && $userId == $item['id'] ? 'selected' : false) ?> ><?php echo $item['fullname'].' ('.$item['email'].')' ?></option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
            <div class="col-3">
                <select name="category_id" id="" class="form-control">
                    <option value="0">Chọn chuyên mục</option>
                    <?php
                    if (!empty($allCategories)):
                        foreach ($allCategories as $item):
                    ?>
                            <option value="<?php echo $item['id'] ?>" <?php echo (!empty($categoryId)) && $categoryId == $item['id'] ? 'selected' : false; ?>><?php echo $item['name']?></option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
            <div class="col-3">
                <input type="search" name="keyword" class="form-control" placeholder="Nhập tên từ khóa tìm kiếm..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
            </div>
        </div>
        <input type="hidden" name="module" value="blog">      <!-- ngăn chuyển về blog chủ -->
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
                <th width="15%">Chuyên mục</th>
                <th width="15%">Đăng bởi</th>
                <th width="10%">Thời gian</th>
                <th width="10%" class="text-center">Nhân bản</th>
                <th width="10%" class="text-center">Sửa</th>
                <th width="10%" class="text-center">Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($listBlog)):
                    foreach ($listBlog as $key=>$item):
            ?>
            <tr>
                <td><?php echo $key + $offset + 1 ?></td>
                <td>
                    <a href="<?php echo getLinkAdmin('blog', 'edit', ['id'=>$item['id']]) ?>">
                        <?php echo $item['title']; ?>
                    </a>
                    <br>
                    <span class="btn btn-success btn-sm"><?php echo $item['view_count'] ?> lượt xem</span>
                    <a href="<?php echo getLinkModule('blog', $item['id']) ?>" target="_blank" class="btn btn-primary btn-sm" target="_blank">Xem</a>
                </td>
                <td>
                    <a href="?<?php echo getLinkQueryString('category_id', $item['category_id']) ?>"><?php echo $item['category_name'] ?></a>
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
                    <a href="<?php echo getLinkAdmin('blog', 'duplicate', ['id'=>$item['id']]) ?>" class="btn btn-danger btn-sm">Nhân bản</a>
                </td>
                <td class="text-center">
                    <a href="<?php echo getLinkAdmin('blog', 'edit', ['id'=>$item['id']]) ?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                </td>
                <td class="text-center">
                    <a href="<?php echo getLinkAdmin('blog', 'delete', ['id'=>$item['id']]) ?>" onclick="confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                        Delete
                    </a>
                </td>
            </tr>
            <?php 
                    endforeach;
                else:
            ?>

                <tr>
                    <td colspan="8" class="text-center">Không có blog</td>
                </tr>

            <?php endif; ?>
        </tbody>
    </table>
    <!-- Phân blog -->
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
                echo '<li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT_ADMIN.'?module=blog'.$queryString.'&page='.$prevPage.'">Trước</a></li>';
            }
            ?>
            <?php for ($index =$begin; $index <= $end; $index++) {  ?>
            <li class="page-item <?php echo ($index==$page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=blog'.$queryString.'&page='.$index;  ?>"><?php echo $index;  ?></a></li>
            <?php } ?>
            <?php
                if ($page < $maxPage) {
                    $nextPage = $page+1;
                    echo '<li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT_ADMIN.'?module=blog'.$queryString.'&page='.$nextPage.'">Sau</a></li>';
                }
            ?>
        </ul>
    </nav>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<?php
layout("footer", 'admin', $data);