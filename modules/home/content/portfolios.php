<?php
use CKSource\CKFinder\Thumbnail\Thumbnail;
$title = getOption('home_portfolio_title');
$titleBg = getOption('home_portfolio_title_bg');
$desc = getOption('home_portfolio_desc');
$moreLink = getOption('home_portfolio_more_link');
$moreText = getOption('home_portfolio_more_text');

// truy vấn danh mục dự án
$portfolioCategories = getRaw("SELECT * FROM portfolio_categories ORDER BY name");
// truy vấn danh sách dự án
$portfolios = getRaw("SELECT * FROM portfolios ORDER BY create_at DESC");
?>
<!-- Portfolio -->
<section id="portfolio" class="portfolio section">
	<div class="container">
		<div class="row">
			<div class="col-12 wow fadeInUp">
				<div class="section-title">
					<?php if (!empty($titleBg)) : ?>
						<span class="title-bg"><?php echo $titleBg ?></span>
					<?php endif; ?>

					<?php if (!empty($title)) : ?>
						<h1><?php echo $title ?></h1>
					<?php endif; ?>

					<?php if (!empty($desc)) : ?>
						<?php echo html_entity_decode($desc) ?>
					<?php endif; ?>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<!-- portfolio Nav -->
				<div class="portfolio-nav">
					<ul class="tr-list list-inline" id="portfolio-menu">
						<li data-filter="*" class="cbp-filter-item active">Tất cả dự án<div class="cbp-filter-counter"></div>
						</li>
						<?php
						if (!empty($portfolioCategories)) {
							foreach ($portfolioCategories as $item) {
								echo '<li data-filter=".category_'.$item['id'].'" class="cbp-filter-item">
										'.$item['name'].'
										<div class="cbp-filter-counter"></div>
									  </li>';
							}
						}

						?>
						
					</ul>
				</div>
				<!--/ End portfolio Nav -->
			</div>
		</div>
		<div class="portfolio-inner">
			<div class="row">
				<div class="col-12">
					<div id="portfolio-item">
						<?php if (!empty($portfolios)): foreach ($portfolios as $item): ?>
						<!-- Single portfolio -->
						<div class="cbp-item category_<?php echo $item['portfolio_category_id'] ?>">
							<div class="portfolio-single">
								<div class="portfolio-head">
									<img src="<?php echo $item['thumbnail']; ?>" alt="#" />
								</div>
								<div class="portfolio-hover">
									<h4><a href="<?php echo getLinkModule('portfolios', $item['id']); ?>" target="_blank"><?php echo $item['name']; ?></a></h4>
									<?php echo '<p>'.$item['description'].'</p>'; ?>
									<div class="button">
										<a class="primary" data-fancybox="gallery" href="<?php echo $item['thumbnail']; ?>"><i class="fa fa-search"></i></a>
										<?php if (!empty($item['video'])): ?>
										<a href="<?php echo $item['video']; ?>" class="primary cbp-lightbox"><i class="fa fa-play"></i></a>
										<?php endif; ?>
										<a href="<?php echo getLinkModule('portfolios', $item['id']); ?> " target="_blank"><i class="fa fa-link"></i></a>
									</div>
								</div>
							</div>
						</div>
						<!--/ End portfolio -->
						<?php endforeach; endif; ?>
					</div>
				</div>
				<?php if (!empty($moreLink) && empty($isPortfolioPage)) : ?>
					<div class="col-12">
						<div class="button">
							<a class="btn primary" href="<?php echo $moreLink ?>"><?php echo !empty($moreText) ? $moreText : 'Xem thêm dự án' ?></a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<!--/ End portfolio -->