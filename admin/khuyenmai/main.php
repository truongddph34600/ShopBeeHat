<?php 
	if(isset($_GET['view'])){
		$view=$_GET['view'];
		switch ($view) {
		case 'them':
                        					include_once('khuyenmai/them.php');
                        				break;
			case 'sua':

					include_once('khuyenmai/sua.php');
				break;
			case 'apply':

					include_once('khuyenmai/apply.php');
				break;

			default:
				break;
		}
	}
	else{
		include_once('khuyenmai/khuyenmai.php');
	}

?>