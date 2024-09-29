<?php
if (!defined("_INCODE")) die('Access Deined...');
?>
<!-- <div class="debug-wrapper" style="width: 600px; padding: 20px 30px; text-align: center; margin: 0 auto"> -->
<div class="debug-wrapper">
    <h2 style="text-transform: uppercase;">Vui lòng kiểm tra và sữa những lỗi sau</h2>

    <p>
    <div style="text-align: left; color: red; border: 1px solid red; padding: 5px 15px">
        <?php
        echo '';
        echo 'Code: ' . $debugError['error_code'] . '<br>';
        echo $debugError['error_message'] . '<br>';
        echo 'File: ' . $debugError['error_file'] . '<br>';
        echo 'Line: ' . $debugError['error_line'] . '<br>';
        echo '';
        ?>
    </div>
    </p>

</div>