<?php
include_once('../../model/database.php');
// Thêm màu
if(isset($_GET['themmau'])){
    $mamau=$_GET['mamau'];
    $sql="insert into mau(MaMau) values(N'$mamau')";
    $rs=mysqli_query($conn,$sql);
    if(isset($rs)){
        header('location:../index.php?action=mau&view=themmau&thongbao=them');
    }else{
        header('location:../index.php?action=mau&view=themmau&thongbao=loi');
    }
}
//----------------------------------------