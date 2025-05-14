<?php
    $id=$_GET['id'];
    $sql_sua="SELECT * FROM `phieugiamgia` WHERE MaGG=$id";
    $rs_sua=mysqli_query($conn,$sql_sua);
    $kq=mysqli_fetch_array($rs_sua)
?>


<div class="container-fluid">
    <div class=" alert alert-primary">
        <h4 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
            </span> ADMIN &#160;<i class="fas fa-chevron-right" style="font-size: 18px"></i>&#160; Phiếu Giảm Giá
        </h4>
    </div>
    <div class="card card-body ">
        <div class="row">
            <form class="form-row " method="GET" action="phieugiamgia/xuly.php" enctype="multipart/form-data">
                <div class="form-group col-sm-4">
                    <label class="m-auto" for="th">Tên Phiếu Giảm Giá</label>
                    <input type="text" class="form-control" name="tgg" value="<?php echo $kq['TenGG'] ?>" required>
                    <input hidden class="form-control" name="magg" value="<?php echo $kq['MaGG'] ?>">
                </div>

                <div class="form-group col-sm-4">
                    <label class="m-auto" for="th">Tiền Giảm Giá</label>
                    <input type="text" class="form-control" name="t" value="<?php echo $kq['TienGG'] ?>">
                </div>

                <div class="form-group col-sm-4 "></div>
                <div class="form-group col-sm-3 "><label for="masv">&emsp;</label><input type="submit"
                        class="form-control badge-info" name="sua" value="Cập Nhập"></div>
                <hr>
            </form>
        </div>

    </div>