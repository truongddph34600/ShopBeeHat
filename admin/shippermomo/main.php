
<?php
if(isset($_GET['view'])) {
    $view = $_GET['view'];
    switch ($view) {
        case 'giaohangmomo':
            include_once('shippermomo/donhang.php');
            break;

        case 'ctgh':
            include_once('shippermomo/chitietdathang.php');
            break;

        default:
            include_once('shippermomo/donhang.php');
            break;
    }
} else {
    include_once('shippermomo/donhang.php');
}
?>