<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
/* file này dùng để xóa dự án */
$body = getBody();
if (!empty( $body['id'] ) ) {
    $portfolioId = $body['id'];
    $portfolioDetail = firstRaw("SELECT * FROM `portfolios` WHERE id='$portfolioId'");
    if ( !empty( $portfolioDetail ) ) {
        // loại bỏ thời gian tạo (create_at) và thời gian cập nhật (update_at), id
        $portfolioDetail['create_at'] = date('Y-m-d H:i:s');

        unset($portfolioDetail['update_at']);
        unset($portfolioDetail['id']);

        $duplicate = $portfolioDetail['duplicate'];
        $duplicate++;
        $portfolioDetail['duplicate'] = 0;

        $name = $portfolioDetail['name'].' ('.$duplicate.')';
        $portfolioDetail['name'] = $name;

        $insertStatus = insert('portfolios', $portfolioDetail);
        if ($insertStatus) { 
            setFlashData('msg', 'Nhân bản dự án thành công');
            setFlashData('msg_type', 'success');
            update('portfolios', ['duplicate' => $duplicate], "id=$portfolioId");
        }
    }
    else {
        setFlashData('msg','dự án không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}
else {
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin?module=portfolios');