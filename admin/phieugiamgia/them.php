<div class="container-fluid">
    <div class=" alert alert-primary">
        <h4 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
            </span> ADMIN &#160;<i class="fas fa-chevron-right" style="font-size: 18px"></i>&#160; Phiếu Giảm Giá
        </h4>
    </div>
    <div class="card card-body ">
        <form class="form-row " method="GET" action="phieugiamgia/xuly.php" enctype="multipart/form-data">
            <div class="form-group col-sm-4">
                <label class="m-auto" for="th">Tên Phiếu Giảm Giá</label><input type="text" class="form-control" name="tengg"
                    required>
            </div>
            <div class="form-group col-sm-4">
                <label class="m-auto" for="th">Tiền Giảm Giá</label><input type="text" class="form-control" name="tiengg">
            </div>

            <div class="form-group col-sm-4 "></div>
            <div class="form-group col-sm-3 "><label>&emsp;</label><input type="submit" class="form-control badge-info"
                    name="them" value="Thêm"></div>
            <hr>
        </form>
        <br>
        <hr>