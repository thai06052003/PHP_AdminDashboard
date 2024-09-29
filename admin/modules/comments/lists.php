<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh sách Bình luận',
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
        $filter .= " $operator comment.name LIKE '%$keyword%' OR comment.email LIKE '%$keyword%' OR comment.website LIKE '%$keyword%' OR comment.content LIKE '%$keyword%'";
    }

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

        $filter .= "WHERE comment.status=$statusSql";
    }

    // xử lý lọc theo user
    if (!empty($body["user_id"])) {
        $userId = $body['user_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator comment.user_id=$userId";
    }
}

// xử lí phân trang

// 1. lấy số lượng bản ghi trang
$allCommentNum = getRows("SELECT id FROM `comment` $filter");

// 2. số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE;

// 3. tính số trang
$maxPage = ceil($allCommentNum / $perPage);    // làm tròn lên

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
// lấy dữ liệu bình luận
$listComment = getRaw("SELECT comment.*, blog.title
                    FROM comment INNER JOIN blog ON comment.blog_id = blog.id
                    $filter
                    ORDER BY comment.create_at DESC  LIMIT $offset, $perPage");
/* echo '<pre>';
print_r($listComment);
echo '</pre>';
die(); */
// xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
   /*  echo $queryString.'<br>'; */
    $queryString = str_replace('module=comments', '', $queryString);
   /*  echo $queryString.'<br>'; */
    $queryString = str_replace('&page=' . $page, '', $queryString);
   /*  echo $queryString.'<br>'; */
    $queryString = trim($queryString, '&');
   /*  echo $queryString.'<br>'; */
    $queryString = '&' . $queryString;
   /*  echo $queryString.'<br>'; */
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
        <form action="" method="get">
            <div class="row mb-3">
                <div class="col-3">
                    <select name="user_id" id="" class="form-control">
                        <option value="0">Chọn người dùng</option>
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
                <div class="col-3">
                    <div class="form-group">
                        <select name="status" id="" class="form-control">
                            <option value="0">Chọn trạng thái</option>
                            <option value="1" <?php echo (!empty($status) && $status == 1) ? 'selected' : false ?>>Đã duyệt</option>
                            <option value="2" <?php echo (!empty($status) && $status == 2) ? 'selected' : false ?>>Chưa duyệt</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <input type="search" name="keyword" class="form-control" placeholder="Từ khóa tìm kiếm..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="comments"> <!-- ngăn chuyển về trang chủ -->
        </form>
        <?php
        getMsg($msg, $msgType);
        ?>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Thông tin</th>
                    <th width="10%">Nội dung</th>
                    <th width="12%">Trạng thái</th>
                    <th width="10%">Thời gian</th>
                    <th class="text-center">Bài viết</th>
                    <th width="10%" class="text-center">Sửa</th>
                    <th width="10%" class="text-center">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listComment)) :
                    foreach ($listComment as $key => $item) :
                ?>
                        <tr>
                            <td><?php echo $key + $offset + 1 ?></td>
                            <td>
                                - Họ tên: <?php echo $item['name'] ?><br>
                                - Email: <?php echo $item['email'] ?><br>
                                <?php if (!empty($item['website'])) {
                                    echo '- Website: '.$item['website'];
                                } ?><br>
                                <?php 
                                if (!empty($item['parent_id'])) {
                                    $commentData = getComment($item['parent_id']);
                                    if (!empty($commentData['name'])) {
                                        echo 'Trả lời: '.$commentData['name'];
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                echo getLimitText($item['content']);
                                ?>
                            </td>
                            <td>
                                <?php 
                                echo $item['status'] == 0 ? '<button class="btn btn-warning btn-sm">Chưa duyệt</button> <br>' : '<button class="btn btn-success btn-sm">Đã duyệt</button> <br>' ;
                                if ($item['status']==0) {
                                    echo '<a href="'._WEB_HOST_ROOT_ADMIN.'?module=comments&action=status&id='.$item['id'].'&status=1'.'" class="text-success mt-2">Duyệt</a>';
                                }
                                else {
                                    echo '<a href="'._WEB_HOST_ROOT_ADMIN.'?module=comments&action=status&id='.$item['id'].'&status=0'.'" class="text-danger mt-2">Bỏ duyệt</a>';
                                }
                                ?>
                            </td>
                            <td> 
                                <?php echo getDateFormat($item['create_at'], 'H:i:s d/m/Y'); ?> 
                            </td>

                            <td class="text-left">
                                <?php
                                if ($item['status']==1) {
                                    echo '<a href="'.getLinkModule('blog', $item['blog_id']).'" target="_blank">'.getLimitText($item['title'], 5) .'</a>';
                                }
                                else {
                                    echo '<a href="'.getLinkModule('blog', $item['blog_id']).'" target="_blank">'.getLimitText($item['title'], 5).' <span class="text-danger">(Chưa duyệt)</span></a>';
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo getLinkAdmin('comments', 'edit', ['id' => $item['id']]) ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo getLinkAdmin('comments', 'delete', ['id' => $item['id']]) ?>" onclick="confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">
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
                        <td colspan="8" class="text-center">Không có bình luận</td>
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
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=comments' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
                }
                ?>
                <?php for ($index = $begin; $index <= $end; $index++) {  ?>
                    <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=comments' . $queryString . '&page=' . $index;  ?>"><?php echo $index;  ?></a></li>
                <?php } ?>
                <?php
                if ($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=comments' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<?php
layout("footer", 'admin', $data);
