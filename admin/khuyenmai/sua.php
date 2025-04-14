<?php 
    $id = intval($_GET['makm']); // Đảm bảo an toàn hơn
    $sql_sua = "SELECT * FROM `khuyenmai` WHERE MaKM = $id";
    $rs_sua = mysqli_query($conn, $sql_sua);
    $kq = mysqli_fetch_array($rs_sua);
?>

<div class="container-fluid">
    <!-- Tiêu đề -->
    <div class="alert alert-primary">
        <h4 class="page-title">
            <i class="fas fa-tags text-primary"></i> Sửa Khuyến Mãi
        </h4>
    </div>

    <!-- Form sửa -->
    <div class="card card-body shadow-sm">
        <form class="form-row" method="GET" action="khuyenmai/xuly.php" enctype="multipart/form-data">
            <!-- Tên khuyến mãi -->
            <div class="form-group col-md-4">
                <label for="tkm">Tên khuyến mãi</label>
                <input type="text" class="form-control" name="tkm" value="<?= $kq['TenKM'] ?>" required>
                <input type="hidden" name="makm" value="<?= $kq['MaKM'] ?>">
            </div>

            <!-- Ngày bắt đầu -->
            <div class="form-group col-md-4">
                <label for="nbd">Ngày bắt đầu</label>
                <input type="date" class="form-control" name="nbd" value="<?= $kq['NgayBD'] ?>" required>
            </div>

            <!-- Ngày kết thúc -->
            <div class="form-group col-md-4">
                <label for="nkt">Ngày kết thúc</label>
                <input type="date" class="form-control" name="nkt" value="<?= $kq['NgayKT'] ?>" required>
            </div>

            <!-- Tiền khuyến mãi -->
            <div class="form-group col-md-4">
                <label for="t">Tiền giảm giá (VNĐ)</label>
                <input type="number" class="form-control" name="t" value="<?= $kq['TienKM'] ?>" min="0">
            </div>

            <!-- Phần trăm khuyến mãi -->
            <div class="form-group col-md-4">
                <label for="pt">% giảm giá</label>
                <input type="number" class="form-control" name="pt" value="<?= $kq['KM_PT'] ?>" min="0" max="100">
            </div>

            <!-- Mô tả -->
            <div class="form-group col-md-4">
                <label for="mt">Mô tả</label>
                <textarea class="form-control" name="mt" rows="3" required><?= $kq['MoTa'] ?></textarea>
            </div>

            <!-- Nút cập nhật -->
            <div class="form-group col-md-12 text-center mt-3">
                <input type="submit" class="btn btn-info px-4" name="sua" value="Cập nhật khuyến mãi">
            </div>
        </form>
    </div>
</div>
