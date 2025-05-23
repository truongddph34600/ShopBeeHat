<?php
session_start();
include_once('../../model/database.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
if(isset($_GET['action'])){
	$action=$_GET['action'];
	switch ($action) {
		case 'duyet':
			$mahd=$_GET['mahd'];
			$admin=$_SESSION['admin'];$manv=$admin['MaNV'];
  			$sql="update hoadonmomo set MaNVGH = '$manv',  Trangthai='hoàn thành' where MaHD=$mahd";
  			$rs=mysqli_query($conn,$sql);
  			if($rs){
  				header('location:../index.php?action=giaohangmomo');
  			}
			break;

		default:
			# code...
			break;
	}
}


?>