<?php
if (!defined("_INCODE")) die('Access Deined...');
if (!empty(getBody('get')['id'])) {
    $id = getBody('get')['id'];
    
    setView($id);   // tăng view

    $blogDetail = firstRaw("SELECT blog.*, blog_categories.name as category_name, blog_categories.id as category_id, users.fullname, users.email, users.about_content, users.contact_facebook, users.contact_twitter, users.contact_linkedin, users.contact_pinterest, groups.name as group_name, (SELECT count(id) FROM blog WHERE user_id = users.id) as blog_count
                            FROM blog join blog_categories on blog.category_id = blog_categories.id
                                      join users on blog.user_id = users.id
                                      join `groups` on users.group_id = `groups`.id
                            WHERE blog.id = $id");

    /* echo '<pre>';
    print_r($blogDetail);
    echo '</pre>';
    die(); */

    if (empty($blogDetail)) {
        loadError();
    }
} else {
    loadError();
}
/* echo '<pre>';
print_r($blogDetail);
echo '</pre>'; */

$parentBreacrumb = '<li><a href="' . _WEB_HOST_ROOT . '/?module=blog' . '">' . getOption('blog-title') . '</a></li>';
$parentBreacrumb .= '<li><a href="' . _WEB_HOST_ROOT . '/?module=blog&action=category&id=' . $blogDetail['category_id'] . '">' . $blogDetail['category_name'] . '</a></li>';

$data = [
    'pageTitle' => $blogDetail['title'],
    'pageName' => getOption('blog-title'),
    'itemParent' => $parentBreacrumb,
    'breadcrumbLimit' => 5,
];

layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);

// truy vấn lấy tất cả bài viết
$allBlog = getRaw("SELECT * FROM blog ORDER BY create_at DESC");

$currentKey = array_search($id, array_column($allBlog, 'id'));

$userEmail = $blogDetail['email'];
$hashGravatar = md5($userEmail);
$avatarUrt = 'https://www.gravatar.com/avatar/' . $hashGravatar.'?s=400';

?>

<!-- Blogs Area -->
<section class="blogs-main archives single section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-12">
                <div class="row">
                    <div class="col-12">
                        <!-- Single Blog -->
                        <div class="single-blog">
                            <?php
                            if (!empty($blogDetail['thumbnail'])) :
                            ?>
                                <div class="blog-head">
                                    <img src="<?php echo $blogDetail['thumbnail']; ?>" alt="#">
                                </div>
                            <?php endif; ?>
                            <div class="blog-inner">
                                <div class="blog-top">
                                    <div class="meta">
                                        <?php

                                        ?>
                                        <span><i class="fa fa-bolt"></i><?php echo '<a href="' . _WEB_HOST_ROOT . '/?module=blog&action=category&id=' . $blogDetail['category_id'] . '">' . $blogDetail['category_name'] . '</a>'; ?></span>
                                        <span><i class="fa fa-calendar"></i><?php echo getDateFormat($blogDetail['create_at'], 'd/m/Y') ?></span>
                                        <span><i class="fa fa-eye"></i><?php echo $blogDetail['view_count'] ?></span>
                                    </div>
                                    <ul class="social-share">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo _WEB_HOST_ROOT . '/?module=blog&action=detail&id=' . $blogDetail['id'] ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/share?text=<?php echo $blogDetail['title'] . 'url=' . _WEB_HOST_ROOT . '/?module=blog&action=detail&id=' . $blogDetail['id'] ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="https://www.linkedin.com/shareArticle?url=<?php echo _WEB_HOST_ROOT . '/?module=blog&action=detail&id=' . $blogDetail['id'] ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="http://pinterest.com/pin/create/button/?url==<?php echo _WEB_HOST_ROOT . '/?module=blog&action=detail&id=' . $blogDetail['id'] . '&description=' . $blogDetail['title']; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                    </ul>
                                </div>
                                <h2><?php echo $blogDetail['title'] ?></h2>
                                <?php echo html_entity_decode($blogDetail['content']) ?>
                                <div class="bottom-area">
                                    <!-- Next Prev -->
                                    <ul class="arrow">
                                        <?php if ($currentKey > 0) : ?>
                                            <li class="prev"><a href="<?php echo _WEB_HOST_ROOT . '/?module=blog&action=detail&id=' . $allBlog[$currentKey - 1]['id'] ?>"><i class="fa fa-angle-double-left"></i>Bài trước</a></li>
                                        <?php endif; ?>
                                        <?php if ($currentKey < count($allBlog) - 1) : ?>
                                            <li class="next"><a href="<?php echo _WEB_HOST_ROOT . '/?module=blog&action=detail&id=' . $allBlog[$currentKey + 1]['id'] ?>">Bài sau<i class="fa fa-angle-double-right"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
                                    <!--/ End Next Prev -->
                                </div>
                            </div>
                        </div>
                        <!-- End Single Blog -->
                    </div>
                    <div class="col-12">
                        <div class="author-details">
                            <div class="author-left">
                                <?php
                                echo '<img src="'.$avatarUrt.'" alt="#">';
                                echo '<h4>'.$blogDetail['fullname'].'<span>'.$blogDetail['group_name'].'</span></h4>';
                                echo '<p><a href="#"><i class="fa fa-pencil"></i>'.$blogDetail['blog_count'].' bài viết</a></p>';
                                ?>
                                
                                
                            </div>
                            <div class="author-content">
                                <?php echo html_entity_decode($blogDetail['about_content']) ?>
                                <ul class="social-share">
                                    <li><a href="<?php echo $blogDetail['contact_facebook'] ?>"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="<?php echo $blogDetail['contact_twitter'] ?>"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="<?php echo $blogDetail['contact_linkedin'] ?>"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="<?php echo $blogDetail['contact_pinterest'] ?>"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <?php require_once  _WEB_PATH_ROOT.'/modules/blog/comment_lists.php' ?>
                    </div>
                    <div class="col-12">
                        <?php require_once  _WEB_PATH_ROOT.'/modules/blog/comment_form.php'?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Blogs Area -->

<?php
layout('footer', 'client');
