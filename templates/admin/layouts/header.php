<?php
// kiểm tra trạng thái đăng nhập
if (!defined("_INCODE")) die("Access Deined...");

if (!islogin()) {
  redirect("admin/?module=auth&action=login");
} else {
  $userId = islogin()['user_id'];
  $userDetail = getUserInfo($userId);
}

saveActivity();   // lưu lại hoạt động cuối cùng của user
autoRemoveTokenLogin();    // tự động xóa token login

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $data['pageTitle']; ?></title>
  <!-- Favicon -->
  <?php
    $faviconUrl = getOption('header_favicon');
    if (!empty($faviconUrl)) :
    ?>
        <link rel="icon" type="image/png" href="<?php echo $faviconUrl; ?>">
    <?php endif; ?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/summernote/summernote-bs4.css">
  <!-- font-awesome 4.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  <!-- style -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/css/style.css?ver=<?php echo rand(); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Ranger -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
  <!-- Ckeditor -->
  <script type="text/javascript" src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/ckeditor-main/ckeditor.js"></script>
  <!-- Ckfinder -->
  <script type="text/javascript" src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/ckfinder-main/ckfinder.js"></script>
  <?php
  head();
  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"> Hi, </i> <?php echo $userDetail['fullname']; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="<?php echo getLinkAdmin('users', 'profile'); ?>" class="dropdown-item">
              <i class="fa fa-angle-right mr-2"></i>
              Thông tin cá nhân
            </a>
            <a href="<?php echo getLinkAdmin('users', 'change_password'); ?>" class="dropdown-item">
              <i class="fa fa-angle-right mr-2"></i>
              Đổi mật khẩu
            </a>
            <a href="<?php echo getLinkAdmin('auth', 'logout'); ?>" class="dropdown-item">
              <i class="fa fa-angle-right mr-2"></i>
              Đăng xuất
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->