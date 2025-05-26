<?php
if(isset($_GET['view'])) {
    $view = $_GET['view'];
    switch ($view) {
        case 'momo':
            include_once('momo/donhang.php');
            break;
        case 'chitiet':
            include_once('momo/momo_chitiet.php');
            break;
        default:
            include_once('momo/donhang.php');
            break;
    }
} else {
    include_once('momo/donhang.php');
}
?>