<?php
		$rs1=mysqli_query($conn,$sql);
 ?>
  <form class="form-row " method="POST" action="khachhang/xuly.php" enctype="multipart/form-data">
		<div class="form-group col-sm-1"></div>
	    <div class="form-group col-sm-3"><label class="m-auto" for="">Họ Tên</label>
	    	<input type="text" class="form-control" name="tenkh" autofocus required>
	    </div>
	    <div class="form-group col-sm-3"><label class="m-auto" for="">Email</label>
	    	<input type="email" class="form-control" name="email"  required>
	    </div>
	    <div class="form-group col-sm-3"><label class="m-auto" for="">SĐT</label>
	    	<input type="text" class="form-control" name="sdt" required>
	    </div>
		<div class="form-group col-sm-2"></div><div class="form-group col-sm-1"></div>
	    <div class="form-group col-sm-3"><label class="m-auto" for="">Địa Chỉ</label>
	    	<input type="text" class="form-control" name="dc" required>
	    </div>
	    <div class="form-group col-sm-3"><label class="m-auto" for="">Mật Khẩu</label>
	    	<input type="text" class="form-control" name="mk" required>
	    </div>
	    <div class="form-group col-sm-4"></div>
	    <div class="form-group col-sm-3"><label for="makh">&emsp;</label><input type="submit" class="form-control badge-info" name="them" value="Thêm"></div>
	    <hr>
 </form><hr class=" badge-danger">
