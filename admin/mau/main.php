<?php 
include_once('../model/database.php');

$view = $_GET['view'] ?? '';

switch ($view) {
    case 'themmau':
        include_once('them.php');	
        break;
    default:
        include_once('them.php');
        break;
}
?>
