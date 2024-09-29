<?php
if (!defined("_INCODE")) die('Access Deined...');

if (!empty(getBody()['id'])) {
    $id = getBody()['id'];

    // thực hiện truy vấn với bảng portfolio
    $sql = "SELECT p.*, pc.name as categoryName
            FROM portfolios as p INNER JOIN portfolio_categories as pc on p.portfolio_category_id = pc.id
            WHERE p.id=$id";

    $portfolioDetail = firstRaw($sql);
    $portfolioImage = getRaw("SELECT image FROM portfolio_images WHERE portfolio_id = $id");

    if (empty($portfolioDetail)) {
        loadError();
    }
} else {
    loadError();    // load giao diện 404
}

$data = [
    'pageTitle' => $portfolioDetail['name'],
];

layout('header', 'client', $data);
$data['itemPartent'] = '<li><a href="' . _WEB_HOST_ROOT . '?module=portfolio">' . getOption('portfolio-title') . '</a></li>';
layout('breadcrumb', 'client', $data);

?>
<!-- Services -->
<section id="portfolio" class="services archives section">
    <div class="container">
        <h1 class="text-small"><?php echo $portfolioDetail['name'] ?></h1>
        <div class="portfolio-meta">
            Chuyên mục: <?php echo $portfolioDetail['categoryName'] ?> | Thời gian: <?php echo getDateFormat($portfolioDetail['create_at'], 'd/m/y') ?>
        </div>
        <hr>
        <div>
            <?php echo html_entity_decode($portfolioDetail['content']) ?>
        </div>
        <div class="row" style="margin-top: 20px;">
            <?php
            $checkVideo = false;
            if (!empty($portfolioDetail['video'])) :
                $checkVideo = true;
            ?>
                <div class="col-6">
                    <h3>Video</h3>
                    <hr>
                    <?php
                    $videoId = getYoutubeId($portfolioDetail['video']);
                    if (!empty($videoId)) {
                        echo '<iframe width="100%" height="315" src="https://www.youtube.com/embed/' . $videoId . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php
            if ($checkVideo) {
                echo '<div class="col-6">';
            } else {
                echo '<div class="col-12">';
            }
            if (!empty($portfolioImage)) :
            ?>
                <h3>Ảnh dự án</h3>
                <hr>
                <div class="row">
                    <?php foreach ($portfolioImage as $item) : ?>
                    <div class="col-4 mb-4">
                        <a href="<?php echo $item['image'] ?>" data-fancybox="gallery">
                            <img data-fancybox="gallery" src="<?php echo $item['image'] ?>" alt="">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php
                echo '</div>';
            endif;
            ?>
        </div>
    </div>
</section>
<!--/ End Services -->

<!-- Partners -->
<!--/ End Partners -->
<?php
layout('footer', 'client');
