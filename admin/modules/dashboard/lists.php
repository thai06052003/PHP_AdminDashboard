<?php
$data = [
  'pageTitle' => 'Tổng quan',
];
layout("header", 'admin', $data);
layout("sidebar", 'admin', $data);

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
if (!empty($msg) && !empty($msgType)):
?>

<div class="container-fluid">
  <div class="content-header">
    <?php
    getMsg($msg, $msgType);
    ?>
  </div>
</div>

<?php
endif;
layout('breadcrumb', 'admin', $data);
?>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo getSubscribe(); ?></h3>

            <p>Đăng ký nhận tin</p>
          </div>
          <div class="icon">
            <i class="nav-icon far fa-folder-open"></i>
          </div>
          <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=subscribe'; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?php echo getCommentCount(); ?></h3>

            <p>Bình luận</p>
          </div>
          <div class="icon">
            <i class="nav-icon fas fa-comment-dots"></i>
          </div>
          <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=comments'; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?php echo getCountContact(); ?></h3>

            <p>Liên hệ</p>
          </div>
          <div class="icon">
            <i class="fa fa-phone" aria-hidden="true"></i>
          </div>
          <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=contacts'; ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>

    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<?php
layout("footer", 'admin', $data);
