<?php
	include_once('../model/database.php');
	if(isset($_GET['view'])){
		$view=$_GET['view'];
		switch ($view) {
			case 'them':
					include_once('khachhang/them.php');
				break;
			case 'sua':
					include_once('khachhang/sua.php');
				break;
			case 'xoa':
					include_once('khachhang/xoa.php?view='.$view);
				break;
			default:

				break;
		}
	}
	else{
		include_once('khachhang/thongtin.php');
	}


?>