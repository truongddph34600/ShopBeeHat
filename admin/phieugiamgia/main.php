<?php
if (isset($_GET['view'])) {
    switch ($_GET['view']) {
        case 'sua':
            include_once('phieugiamgia/sua.php');
            break;
        default:
            break;
    }
} else {
    include_once('phieugiamgia/them.php');
    include_once('phieugiamgia/phieugiamgia.php');
}
?>
