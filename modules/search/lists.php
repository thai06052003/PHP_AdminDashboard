<?php
if (!defined("_INCODE")) die('Access Deined...');

$keyword = '';

// lấy từ kháo tìm kiếm
if (!empty(getBody()['keyword'])) {
    $keyword = trim(getBody()['keyword']);
}
else {
    loadError();
}

$data = [
    'pageTitle' => 'Tìm kiếm: "' . $keyword . '"',
];

// Xử lí thuật toán phân trang
$allBlogNum = getRows("SELECT id FROM blog WHERE title LIKE '%$keyword%' OR content LIKE '%$keyword%'");

$perPage = getOption('blog-per-page');

$maxPage = ceil($allBlogNum / $perPage);

if (!empty(getBody()['page'])) {
    $page = getBody()['page'];
    if ($page < 1 || $page > $maxPage) {
        $page = 1;
    }
} else {
    $page = 1;
}
$offset = ($page - 1) * $perPage;

// truy vấn blog
$listBlog = getRaw("SELECT title, description, blog.id, blog_categories.name as category_name, thumbnail, blog.create_at as create_at, view_count 
					FROM blog join blog_categories on blog.category_id = blog_categories.id
                    WHERE blog.title LIKE '%$keyword%' OR blog.content LIKE '%$keyword%'
                    ORDER BY blog.create_at DESC LIMIT $offset, $perPage");
/* echo '<pre>';
print_r($listBlog);
echo '</pre>'; */

layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);

?>

<!-- Blogs Area -->
<section class="blogs-main archives section">
    <div class="container">
        <h3>Đã tìm thấy <?php echo $allBlogNum; ?> kết quả tìm kiếm</h3>
        <hr>
        <?php if (!empty($listBlog)) : ?>
            <div class="row">
                <?php foreach ($listBlog as $item) : ?>
                    <div class="col-lg-4 col-12">
                        <!-- Single Blog -->
                        <div class="single-blog">
                            <div class="blog-head">
                                <img src="<?php echo $item['thumbnail']; ?>" alt="#">
                            </div>
                            <div class="blog-bottom">
                                <div class="blog-inner">
                                    <h4><a href="<?php echo _WEB_HOST_ROOT . '/?module=blog&action=detail&id=' . $item['id']; ?>"><?php echo $item['title']; ?></a></h4>
                                    <p><?php echo $item['description']; ?></p>
                                    <div class="meta">
                                        <span><i class="fa fa-bolt"></i><a href="#"><?php echo $item['category_name']; ?></a></span>
                                        <span><i class="fa fa-calendar"></i><?php echo getDateFormat($item['create_at'], 'd/M/y'); ?></span>
                                        <span><i class="fa fa-eye"></i><a href="#"><?php echo $item['view_count']; ?></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Blog -->
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info text-center">Không có bài viết</div>
        <?php endif; ?>

        <?php
        $begin = $page - 2;
        if ($begin < 1) {
            $begin = 1;
        }
        $end = $page + 2;
        if ($end > $maxPage) {
            $end = $maxPage;
        }
        if ($maxPage > 1) :
        ?>
            <div class="row">
                <div class="col-12">
                    <!-- Start Pagination -->
                    <div class="pagination-main">
                        <ul class="pagination">
                            <?php
                            if ($page > 1) {
                                $prevPage = $page - 1;
                                echo '<li class="prev"><a href="' . _WEB_HOST_ROOT . '/?module=search&keyword='.$keyword.'&page=' . $prevPage . '"><i class="fa fa-angle-double-left"></i></a></li>';
                            }
                            ?>
                            <?php for ($index = $begin; $index <= $end; $index++) {
                                $classActive = $page == $index ? 'active' : false;
                                echo '<li class="' . $classActive . '"><a href="' . _WEB_HOST_ROOT . '/?module=search&keyword='.$keyword.'&page=' . $index . '">' . $index . '</a></li>';
                            }
                            ?>
                            <?php
                            if ($page < $maxPage) {
                                $nextPage = $page + 1;
                                echo '<li class="next"><a href="' . _WEB_HOST_ROOT . '/?module=search&keyword='.$keyword.'&page=' . $nextPage . '"><i class="fa fa-angle-double-right"></i></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <!--/ End Pagination -->
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<!--/ End Blogs Area -->

<?php
layout('footer', 'client');
