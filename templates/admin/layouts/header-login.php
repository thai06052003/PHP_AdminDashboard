<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
autoRemoveTokenLogin(); // check lastActivity
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'Unicode' ?></title>
    <!-- Favicon -->
    <?php
    $faviconUrl = getOption('header_favicon');
    if (!empty($faviconUrl)) :
    ?>
        <link rel="icon" type="image/png" href="<?php echo $faviconUrl; ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/css/auth.css?ver=<?php echo rand() ?>">
</head>
<body>