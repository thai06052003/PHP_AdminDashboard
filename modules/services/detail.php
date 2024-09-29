<?php
if (!defined("_INCODE")) die('Access Deined...');

if (!empty(getBody()['id'])) {
    $id = getBody()['id'];
    
    // thực hiện truy vấn với bảng services
    $sql = "SELECT * FROM services WHERE id=$id";
    $serviceDetail = firstRaw($sql);
    if (empty($serviceDetail)) {
        loadError();
    }
    /* echo '<pre>';
    print_r($serviceDetail);
    echo '</pre>';
    die(); */
}
else {
    loadError();    // load giao diện 404
}

$data = [
    'pageTitle' => $serviceDetail['name'],
];

layout('header', 'client', $data);
$data['itemParent'] = '<li><a href="'._WEB_HOST_ROOT.'?module=services">'.getOption('service-title').'</a></li>';
layout('breadcrumb', 'client', $data);

?>
<!-- Services -->
<section id="services" class="services archives section">
    <div class="container">
        <h1 class="text-small"><?php echo $serviceDetail['name'] ?></h1>
        <div class="content">
            <?php 
            echo html_entity_decode($serviceDetail['content'] )
            ?>
        </div>
    </div>
</section>
<!--/ End Services -->

<!-- Partners -->
<!--/ End Partners -->
<?php
layout('footer', 'client');
