<?php
if (!defined("_INCODE")) die('Access Deined...');

$data = [
    'pageTitle' => getOption('team-title'),
];

layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);

$title = getOption('team-primary-title');
$titleBg = getOption('team-title-bg');
$desc = getOption('team-desc');
?>

<!-- Start Team -->
<section id="team" class="team section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">

                    <?php
                    echo $titleBg ? '<span class="title-bg">' . $titleBg . '</span>' : false;
                    echo $title ? '<h1>' . $title . '</h1>' : false;
                    echo $desc ? html_entity_decode($desc) : false;
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $teamContentJson = getOption('team-content');
            if (!empty($teamContentJson)) {
                $teamContentArr = json_decode($teamContentJson, true);
                if (!empty($teamContentArr)) {
                    foreach ($teamContentArr as $item) {
            ?>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Team -->
                            <div class="single-team">
                                <div class="t-head">
                                    <img src="<?php echo $item['image'] ?>" alt="#">
                                </div>
                                <div class="t-bottom">
                                    <p><?php echo $item['position'] ?></p>
                                    <h2><?php echo $item['name'] ?></h2>
                                    <ul class="t-social">
                                        <li><a href="<?php echo $item['facebook'] ?>"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="<?php echo $item['twitter'] ?>"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="<?php echo $item['linkedin'] ?>"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="<?php echo $item['behance'] ?>"><i class="fa fa-behance"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Single Team -->
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</section>
<!--/ End Team -->

<?php
layout('footer', 'client');
