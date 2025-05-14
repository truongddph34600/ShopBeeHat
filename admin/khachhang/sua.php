<?php

    $manv=$_GET['makh'];
    $sql_sua="SELECT * FROM `khachhang` WHERE MaKH='$makh'";
    $rs_sua=mysqli_query($conn,$sql_sua);
    $kq_sua=mysqli_fetch_array($rs_sua);
	$rs1=mysqli_query($conn,$sql);

     ?>
  <form class="form-row " method="POST" action="khachhang/xuly.php" enctype="multipart/form-data">
		<div class="form-group col-sm-1"></div><input hidden name="makh" value="<?php echo $kq_sua['MaKH'];?>">
	    <div class="form-group col-sm-3"><label class="m-auto" for="">Họ Tên</label>
	    	<input type="text" class="form-control" name="tenkh" autofocus value="<?php echo $kq_sua['TenKH'];?>">
	    </div>
	    <div class="form-group col-sm-3"><label class="m-auto" for="">Email</label>
	    	<input type="email" class="form-control" name="email" autofocus value="<?php echo $kq_sua['Email'];?>">
	    </div>
	    <div class="form-group col-sm-3"><label class="m-auto" for="">SĐT</label>
	    	<input type="text" class="form-control" name="sdt" autofocus value="<?php echo $kq_sua['SDT'];?>">
	    </div>
		<div class="form-group col-sm-2"></div><div class="form-group col-sm-1"></div>
	    <div class="form-group col-sm-3"><label class="m-auto" for="">Địa Chỉ</label>
	    	<input type="text" class="form-control" name="dc" autofocus value="<?php echo $kq_sua['DiaChi'];?>">
	    </div>
	    <div class="form-group col-sm-3"><label class="m-auto" for="">Mật Khẩu</label>
	    	<input type="text" class="form-control" name="mk" autofocus value="<?php echo $kq_sua['MatKhau'];?>">
	    </div>
	    <div class="form-group col-sm-4"></div>
	    <div class="form-group col-sm-3"><label for="makh">&emsp;</label><input type="submit" class="form-control badge-info" name="sua" value="Cập Nhập"></div>
	    <hr>
 </form><hr class=" badge-danger">
