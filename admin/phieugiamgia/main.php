<?php
	include_once('../model/database.php');
	if(isset($_GET['view'])){
		$view=$_GET['view'];
		switch ($view) {
			case 'them':
					include_once('phieugiamgia/them.php');
				break;
			case 'sua':
					include_once('phieugiamgia/sua.php');
				break;
			case 'xoa':
					include_once('phieugiamgia/xoa.php?view='.$view);
				break;
			default:
				break;
		}
	}
	else{
		include_once('phieugiamgia/phieugiamgia.php');
	}


?>