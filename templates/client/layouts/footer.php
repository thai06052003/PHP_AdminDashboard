<?php
$address = getOption('general_address');
$hotline = getOption('general_hotline');
$email = getOption('general_email');
$linkTwitter = 'https://twitter.com/' . getOption('footer_3_twitter');

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
?>
<!-- Footer -->
<footer id="footer" class="footer wow fadeIn">
    <!-- Top Arrow -->
    <div class="top-arrow">
        <a href="#header" class="btn"><i class="fa fa-angle-up"></i></a>
    </div>
    <!--/ End Top Arrow -->
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- About Widget -->
                    <div class="single-widget about">
                        <h2><?php echo getOption('footer_1_title') ?></h2>
                        <?php echo html_entity_decode(getOption('footer_1_content')) ?>
                        <ul class="list">
                            <?php
                            if (!empty($address)) {
                                echo '<li><i class="fa fa-map-marker"></i>Address: ' . $address . '</li>';
                            }
                            if (!empty($hotline)) {
                                echo '<li><i class="fa fa-headphones"></i>Phone: ' . $hotline . '</li>';
                            }
                            if (!empty($email)) {
                                echo '<li><i class="fa fa-headphones"></i>Email:<a href="mailto:' . $email . '">' . $email . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <!--/ End About Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Links Widget -->
                    <div class="single-widget links">
                        <h2><?php echo getOption('footer_2_title') ?></h2>
                        <?php
                        $footerLinks = html_entity_decode(getOption('footer_2_content'));
                        $footerLinks = str_replace('<ul>', '', $footerLinks);
                        $footerLinks = str_replace('</ul>', '', $footerLinks);
                        echo '<ul class="list">' . $footerLinks . '</ul>';
                        ?>
                    </div>
                    <!--/ End Links Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Twitter Widget -->
                    <div class="single-widget twitter">
                        <h2><?php echo getOption('footer_3_title') ?></h2>
                        <a class="twitter-timeline" data-height="300" data-theme="dark" href="<?php echo $linkTwitter; ?>?ref_src=twsrc%5Etfw">Tweets by XDevelopers</a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                    <!--/ End Twitter Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Newsletter Widget -->
                    <div class="single-widget newsletter" id="newsletter">
                        <h2><?php echo getOption('footer_4_title') ?></h2>
                        <?php
                        echo html_entity_decode(getOption('footer_4_content'));
                        getMsg($msg, $msgType);
                        ?>
                        <form method="post" action="<?php echo _WEB_HOST_ROOT.'/submit-subscribe.html' ?>">
                            <input placeholder="Tên của bạn..." name="fullname" type="text" />
                            <?php echo form_error('fullname', $errors, '<span class="error">', '</span>'); ?>
                            <input placeholder="Email của bạn..." name="email" type="email" />
                            <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                            <button type="submit" class="button primary">Nhận tin</button>
                        </form>
                    </div>
                    <!--/ End Newsletter Widget -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Top -->
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bottom-top">
                        <!-- Social -->
                        <ul class="social">
                                <li><a target="_blank" href="<?php echo getOption('general_facebook'); ?>"><i class="fa fa-facebook"></i></a></li>
                                <li><a target="_blank" href="<?php echo getOption('general_twitter'); ?>"><i class="fa fa-twitter"></i></a></li>
                                <li><a target="_blank" href="<?php echo getOption('general_linkedin'); ?>"><i class="fa fa-linkedin"></i></a></li>
                                <li><a target="_blank" href="<?php echo getOption('general_behance'); ?>"><i class="fa fa-behance"></i></a></li>

                                <li><a target="_blank" href="<?php echo getOption('general_youtube'); ?>"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        <!--/ End Social -->
                        <!-- Copyright -->
                        <div class="copyright">
                            <?php echo html_entity_decode(getOption('footer_copyright')) ?>
                        </div>
                        <!--/ End Copyright -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Bottom -->
</footer>
<!--/ End footer -->

<!-- Jquery -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/jquery.min.js"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/jquery-migrate.min.js"></script>
<!-- Popper JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/bootstrap.min.js"></script>
<!-- Colors JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/colors.js"></script>
<!-- Modernizer JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/modernizr.min.js"></script>
<!-- Nice select JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/niceselect.js"></script>
<!-- Tilt Jquery JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/tilt.jquery.min.js"></script>
<!-- Fancybox  -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/jquery.fancybox.min.js"></script>
<!-- Jquery Nav -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/jquery.nav.js"></script>
<!-- Owl Carousel JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/owl.carousel.min.js"></script>
<!-- Slick Slider JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/slickslider.min.js"></script>
<!-- Cube Portfolio JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/cubeportfolio.min.js"></script>
<!-- Slicknav JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/jquery.slicknav.min.js"></script>
<!-- Jquery Steller JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/jquery.stellar.min.js"></script>
<!-- Magnific Popup JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/magnific-popup.min.js"></script>
<!-- Wow JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/wow.min.js"></script>
<!-- CounterUp JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/jquery.counterup.min.js"></script>
<!-- Waypoint JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/waypoints.min.js"></script>
<!-- Jquery Easing JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/easing.min.js"></script>
<!-- Google Map JS -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnhgNBg6jrSuqhTeKKEFDWI0_5fZLx0vM"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/gmap.min.js"></script>
<!-- Main JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js/main.js?ver=<?php echo rand(); ?>"></script>
<?php foot(); ?>
</body>

</html>