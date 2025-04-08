<?php 	
	if(isset($_GET['view'])){
		$view=$_GET['view'];
		switch ($view) {
			case 'giaohang':
					include_once('shipper/donhang.php');
				break;

			default:			
				break;
		}
	}

?>