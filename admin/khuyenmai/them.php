<div class="container-fluid">
    <!-- Tiêu đề -->
    <div class="alert alert-primary">
        <h4 class="page-title">
            <i class="fas fa-plus-circle text-primary"></i> Thêm Khuyến Mãi
        </h4>
    </div>

    <!-- Form thêm -->
    <div class="card card-body shadow-sm">
        <form class="form-row" method="GET" action="khuyenmai/xuly.php" enctype="multipart/form-data">
            <!-- Tên khuyến mãi -->
            <div class="form-group col-md-4">
                <label for="tkm">Tên khuyến mãi</label>
                <input type="text" class="form-control" name="tkm" placeholder="Nhập tên khuyến mãi" required>
            </div>

            <!-- Ngày bắt đầu -->
            <div class="form-group col-md-4">
                <label for="nbd">Ngày bắt đầu</label>
                <input type="date" class="form-control" name="nbd" required>
            </div>

            <!-- Ngày kết thúc -->
            <div class="form-group col-md-4">
                <label for="nkt">Ngày kết thúc</label>
                <input type="date" class="form-control" name="nkt" required>
            </div>

            <!-- Tiền giảm giá -->
            <div class="form-group col-md-4">
                <label for="t">Tiền giảm giá (VNĐ)</label>
                <input type="number" class="form-control" name="t" placeholder="Nhập số tiền giảm" min="0">
            </div>

            <!-- Phần trăm khuyến mãi -->
            <div class="form-group col-md-4">
                <label for="pt">% giảm giá</label>
                <input type="number" class="form-control" name="pt" placeholder="Nhập % giảm" min="0" max="100">
            </div>

            <!-- Mô tả -->
            <div class="form-group col-md-4">
                <label for="mt">Mô tả</label>
                <textarea class="form-control" name="mt" rows="3" placeholder="Nhập mô tả chi tiết" required></textarea>
            </div>

            <!-- Nút thêm -->
            <div class="form-group col-md-12 text-center mt-3">
                <input type="submit" class="btn btn-success px-4" name="them" value="Thêm khuyến mãi">
            </div>
        </form>
    </div>
</div>
