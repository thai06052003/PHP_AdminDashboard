<?php
if ( ! defined("_INCODE") ) die('Access Deined...');
?>
<div class="" style="width: 600px; padding: 20px 30px; text-align: center; margin: 0 auto">
    <h2 style="text-transform: uppercase;">Lỗi liên quan đến CSDL</h2>
    <hr>
    <p>
        <?php
            echo '<div style="color: red; border: 1px solid red; padding: 5px 15px">';
            echo $e->getMessage() .'<br>';
            echo 'File: '.$e->getFile() .'<br>';
            echo 'Line: '.$e->getLine() .'<br>';
            echo '</div>'; 
        ?>
    </p>
</div>