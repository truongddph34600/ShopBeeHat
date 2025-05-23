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
			$date=getdate();
  			$ngay=$date['year']."-".$date['mon']."-".($date['mday']+1)." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];
  			$sql="update hoadonmomo set NgayGiao = '$ngay', MaNV=$manv, Trangthai='Đã duyệt' where MaHD=$mahd";
  			$rs=mysqli_query($conn,$sql);
  			if($rs){
  				header('location:../index.php?action=xldathangmomo');
  			}
			break;
		case 'huy':
			$mahd=$_GET['mahd'];
			$admin=$_SESSION['admin'];$manv=$admin['MaNV'];
			$sql="update hoadonmomo set  MaNV=$manv, Trangthai='Hủy Bỏ' where MaHD=$mahd";
			$rs=mysqli_query($conn,$sql);
  			if($rs){
  				$sql1="SELECT DISTINCT MaMau FROM `chitiethoadonmomo` WHERE MaHD='$mahd'";
  				$rs1=mysqli_query($conn,$sql1);
  				while ($r1=mysqli_fetch_array($rs1)) {
  					$m=$r1['MaMau'];
  					$sql3="select *from chitiethoadonmomo where MaHD='$mahd' and MaMau='$m'";
  					$rs3=mysqli_query($conn,$sql3);
  					while ($r2=mysqli_fetch_array($rs3)) {
  						$size=$r2['Size'];
  						$sql4="select *from chitiethoadonmomo where MaHD='$mahd' and MaMau='$m' and Size='$size'";
  						$rs4=mysqli_query($conn,$sql4);
  						while ($r3=mysqli_fetch_array($rs4)) {
  							$sl=$r3['SoLuong'];
		  					$masp=$r3['MaSP'];
		  					$sql2="UPDATE `chitietsanpham` set `SoLuong`=(`SoLuong` + '$sl') where `MaSP`='$masp' and `MaSize`='$size' and `MaMau`='$m'";
		  					$rs2=mysqli_query($conn,$sql2);


  						}
  					}
  				}
  				header('location:../index.php?action=xldathangmomo');
  			}
			break;
		default:
			# code...
			break;
	}
}


?>