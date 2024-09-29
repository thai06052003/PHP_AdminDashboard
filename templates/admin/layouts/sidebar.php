<?php
$userId = islogin()['user_id'];
$userDetail = getUserInfo($userId);

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="brand-link">
    <span class="brand-text font-weight-light text-uppercase">Radix admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/user.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="<?php echo getLinkAdmin('users', 'profile'); ?>" class="d-block"><?php echo $userDetail['fullname']; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Trang tổng quan - Begin -->
        <li class="nav-item">
          <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="nav-link <?php echo activeMenuSidebar('') || !isset(getBody()['module']) ? 'active' : false; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p> 
              Tổng quan
            </p>
          </a>
        </li>
        <!-- Trang tổng quan - End -->
        <?php if (checkCurrentPermission('lists', 'services')): ?>
          <!-- Quản lý dịch vụ - Begin -->
          <li class="nav-item has-treeview <?php echo activeMenuSidebar('services') ? 'menu-open' : false; ?>">
            <a href="#" class="nav-link <?php echo activeMenuSidebar('services') ? 'active' : false; ?>">
              <i class="nav-icon fab fa-servicestack"></i>
              <p>
                Quản lý dịch vụ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=services'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <?php if (checkCurrentPermission('add', 'services')) : ?>
                <li class="nav-item">
                  <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=services&action=add'; ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Thêm mới</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
          <!-- Quản lý dịch vụ - End -->
        <?php
        endif; 
        if (checkCurrentPermission('lists', 'pages')):
        ?>
        <!-- Quản lý trang -Begin -->
        <li class="nav-item has-treeview <?php echo activeMenuSidebar('pages') ? 'menu-open' : false; ?>">
          <a href="#" class="nav-link <?php echo activeMenuSidebar('pages') ? 'active' : false; ?>">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Quản lý trang
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=pages'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
            <?php if(checkCurrentPermission('add', 'pages')): ?>
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=pages&action=add'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm mới</p>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <!-- Quản lý trang - End -->
        <?php endif; ?>
        <!-- Quản lý dự án -Begin -->
        <li class="nav-item has-treeview <?php echo activeMenuSidebar('portfolios') || activeMenuSidebar('portfolio_categories') ? 'menu-open' : false; ?>">
          <a href="#" class="nav-link <?php echo activeMenuSidebar('portfolios') || activeMenuSidebar('portfolio_categories') ? 'active' : false; ?>">
            <i class="nav-icon fas fa-project-diagram"></i>
            <p>
              Quản lý dự án
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=portfolios'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách dự án</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=portfolios&action=add'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm mới dự án</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=portfolio_categories'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh mục dự án</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Quản lý dự án - End -->
        <!-- Quản lý bài viết -Begin -->
        <li class="nav-item has-treeview <?php echo activeMenuSidebar('blog') || activeMenuSidebar('blog_categories') ? 'menu-open' : false; ?>">
          <a href="#" class="nav-link <?php echo activeMenuSidebar('blog') || activeMenuSidebar('blog_categories') ? 'active' : false; ?>">
            <i class="nav-icon fas fa-address-card"></i>
            <p>
              Quản lý bài viết
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=blog'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách bài viết</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=blog&action=add'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm mới bài viết</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=blog_categories'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh mục bài viết</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Quản lý bài viết - End -->
        <!-- Nhóm người dùng - Begin -->
        <li class="nav-item has-treeview <?php echo activeMenuSidebar('groups') ? 'menu-open' : false; ?>">
          <a href="#" class="nav-link <?php echo activeMenuSidebar('groups') ? 'active' : false; ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Nhóm người dùng
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=groups'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=groups&action=add'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm mới</p>
              </a>
            </li>

          </ul>
        </li>
        <!-- Nhóm người dùng - End -->

        <!-- Quản lý người dùng -Begin -->
        <li class="nav-item has-treeview <?php echo activeMenuSidebar('users') ? 'menu-open' : false; ?>">
          <a href="#" class="nav-link <?php echo activeMenuSidebar('users') ? 'active' : false; ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Quản lý người dùng
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=users'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=users&action=add'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm mới</p>
              </a>
            </li>

          </ul>
        </li>
        <!-- Quản lý người dùng - End -->
        <!-- Quản lý liên hệ - Begin -->
        <li class="nav-item has-treeview <?php echo activeMenuSidebar('contacts') || activeMenuSidebar('contact_type') ? 'menu-open' : false; ?>">
          <a href="#" class="nav-link <?php echo activeMenuSidebar('contacts') || activeMenuSidebar('contact_type') ? 'active' : false; ?>">
            <i class="nav-icon fa fa-phone" aria-hidden="true"></i>
            <p>
              Quản lý liên hệ <span class="badge badge-danger ml-1"><?php echo getCountContact(); ?></span>
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=contacts'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách <span class="badge badge-danger ml-1"><?php echo getCountContact(); ?></span></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=contact_type'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quản lý phòng ban</p>
              </a>
            </li>

          </ul>
        </li>
        <!-- Quản lý liên hệ - End -->
        <!-- Quản lý bình luận - Begin -->
        <li class="nav-item">
          <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=comments'; ?>" class="nav-link <?php echo activeMenuSidebar('') ? 'active' : false; ?>">
            <i class="nav-icon fas fa-comment-dots"></i>
            <p>
              Quản lý bình luận <span class="badge badge-danger ml-1"><?php echo getCommentCount(); ?></span>
            </p>
          </a>
        </li>
        <!-- Quản lý bình luận - End -->
        <!-- Quản lý đăng ký nhận tin - Begin -->
        <li class="nav-item">
          <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=subscribe'; ?>" class="nav-link <?php echo activeMenuSidebar('') ? 'active' : false; ?>">
            <i class="nav-icon far fa-folder-open"></i>
            <p>
              Đăng ký nhận tin <span class="badge badge-danger ml-1"><?php echo getSubscribe(); ?></span>
            </p>
          </a>
        </li>
        <!-- Quản lý đăng ký nhận tin - End -->
        <!-- Thiết lập -Begin -->
        <li class="nav-item has-treeview <?php echo activeMenuSidebar('options') ? 'menu-open' : false; ?>">
          <a href="#" class="nav-link <?php echo activeMenuSidebar('options') ? 'active' : false; ?>">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Thiết lập
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=options&action=general'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thiết lập chung</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=options&action=header'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thiết lập Header</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=options&action=footer'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thiết lập Footer</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=options&action=about'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thiết lập giới thiệu</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=options&action=team'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thiết lập đội ngũ</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=options&action=services'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thiết lập dịch vụ</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=options&action=portfolios'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thiết lập dự án</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=options&action=blog'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thiết lập bài viết</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=options&action=contact'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thiết lập liên hệ</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=options&action=home'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thiết lập trang chủ</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=options&action=menu'; ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thiết lập menu</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Thiết lập - End -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<div class="content-wrapper">