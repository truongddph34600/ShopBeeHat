<?php
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $date=getdate();
  $thang=$date['year'].'-'.$date['mon'];
  $nam=$date['year'];
  $sql_dtt="SELECT * FROM hoadon WHERE TinhTrang='hoàn thành' and (NgayGiao BETWEEN '".$thang."-00' AND'".$thang."-31')";
  $rs=mysqli_query($conn,$sql_dtt);
  $danhthuthang=0;
  while ( $row=mysqli_fetch_array($rs)) {
        $danhthuthang=$danhthuthang+$row['TongTien'];
  }
  $order=mysqli_num_rows($rs);
  $sql_dtn="SELECT * FROM hoadon WHERE TinhTrang='hoàn thành' and NgayGiao LIKE '".$nam."-%-%'";
  $rsn=mysqli_query($conn,$sql_dtn);
  $danhthunam=0;
  while ( $rown=mysqli_fetch_array($rsn)) {
        $danhthunam=$danhthunam+$rown['TongTien'];
  }
?>