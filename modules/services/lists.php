<?php
if (!defined("_INCODE")) die('Access Deined...');

$data = [
    'pageTitle' => getOption('service-title'),
];

layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);

?>
<!-- Services -->
<section id="services" class="services archives section">
    <div class="container">
        <?php 
		$serviceLists = getRaw("SELECT * FROM services ORDER BY name");
		if (!empty($serviceLists)):
		?>
        <div class="row">
            <div class="col-12">
            <div class="section-title">
					<span class="title-bg"><?php echo getOption('home_service_title_bg'); ?></span>
					<h1><?php echo getOption('home_service_title'); ?></h1>
					<p><?php echo getOption('home_service_desc'); ?>
					<p>
				</div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($serviceLists as $item): ?>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Service -->
                <div class="single-service">
                <?php echo html_entity_decode($item['icon']); ?>
						<h2><a href="<?php echo getLinkModule('services', $item['id']); ?>"><?php echo $item['name']; ?></a></h2>
						<?php echo html_entity_decode($item['description']); ?>
                </div>
                <!-- End Single Service -->
            </div>
            <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
            <div class="alert alert-info text-center">Không có dịch vụ</div>
        <?php endif; ?>
    </div>
</section>
<!--/ End Services -->

<!-- Partners -->
<!--/ End Partners -->
<?php
require_once _WEB_PATH_ROOT.'/modules/home/content/partner.php';
layout('footer', 'client');
