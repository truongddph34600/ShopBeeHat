<?php 
    $id=$_GET['makm'];
    $sql_sua="SELECT * FROM `khuyenmai` WHERE MaKM=$id";
    $rs_sua=mysqli_query($conn,$sql_sua);
    $kq=mysqli_fetch_array($rs_sua)
?>
<!-- Phần header với thiết kế mới -->
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-percent me-2">Mã KM :</i>
            <?php echo $kq['TenKM'] ?>
        </h2>
    </div>
</div>

<!-- Thanh tìm kiếm được cải thiện -->
<div class="container-fluid px-4 mb-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="index.php?action=khuyenmai&view=apply&makm=<?php echo $id ?>" method="POST">
                <div class="input-group">
                    <input class="form-control rounded-start border-end-0" type="search" placeholder="Nhập tên sản phẩm cần tìm..."
                           aria-label="Tìm kiếm" name="tk">
                    <button class="btn btn-primary" name="btsearch" type="submit">
                        <i class="fas fa-search me-1">Tìm kiếm</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Danh sách các thương hiệu dưới dạng card -->
<div class="container-fluid px-4 mb-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-tags me-2"></i>Thương hiệu</h5>
        </div>
        <div class="card-body">
            <form action="index.php?action=khuyenmai&view=apply&makm=<?php echo $id ?>" method="POST">
                <div class="d-flex flex-wrap gap-2">
                    <?php
                    $sql = "SELECT * FROM nhacc";
                    $rs = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($rs)) {
                    ?>
                    <button class="btn btn-outline-secondary" value="<?php echo $row['MaNCC'] ?>" type="submit" name="th">
                        <?php echo $row['TenNCC'] ?>
                    </button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
// code tìm kiếm
if(isset($_POST['btsearch'])){
	$tk=$_POST['tk'];
	$sql="SELECT * FEOM sanpham WHERE TenSP LIKE N'%$tk%' ORDER BY MANCC DESC";
	$rs=mysqli_query($conn,$sql); 
?>

<!-- Bảng dữ liệu sản phẩm với thiết kế mới -->
<div class="container-fluid px-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-search me-2"></i>Kết quả tìm kiếm</h5>
            <div>
                <button class="btn btn-sm btn-outline-primary me-2" type="button" id="btn1">
                    <i class="fas fa-check-square me-1"></i>Chọn tất cả
                </button>
                <button class="btn btn-sm btn-outline-secondary" type="button" id="btn2">
                    <i class="fas fa-square me-1"></i>Bỏ chọn
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <form action="khuyenmai/xuly.php" method="get" accept-charset="utf-8">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr class="bg-light">
                                <th class="text-center">Hình ảnh</th>
                                <th>Mã SP</th>
                                <th>Tên sản phẩm</th>
                                <th>Thương hiệu</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-center">Áp dụng</th>
                                <th class="text-center">Chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($rs)) {
                            $i += 1;
                            $mth = $row['MaNCC'];
                            $sql1 = "SELECT * FROM nhacc WHERE MaNCC='$mth'";
                            $rs1 = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_array($rs1);
                        ?>
                            <tr>
                                <td class="text-center">
                                    <img src="../webroot/image/sanpham/<?php echo $row['AnhNen']; ?>"
                                         class="img-thumbnail" width="60" height="50" alt="<?php echo $row['TenSP']; ?>">
                                </td>
                                <td><?php echo $row['MaSP']; ?></td>
                                <td><?php echo $row['TenSP']; ?></td>
                                <td><?php echo $row1['TenNCC']; ?></td>
                                <td class="text-end fw-bold"><?php echo number_format($row['DonGia']).' đ'; ?></td>
                                <td class="text-center">
                                    <a href="khuyenmai/xuly.php?masp=<?php echo $row['MaSP'] ?>&apply2&makm=<?php echo $id ?>"
                                       class="btn btn-sm btn-success">
                                        <i class="fas fa-check me-1"></i>Áp dụng
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="<?php echo $row['MaSP']; ?>"
                                               name="chon[]" value="<?php echo $row['MaSP']; ?>">
                                        <label class="form-check-label" for="<?php echo $row['MaSP']; ?>"></label>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="makm" value="<?php echo $id ?>">

                <div class="card-footer text-center py-3">
                    <button type="submit" name="apply" class="btn btn-primary px-4">
                        <i class="fas fa-paper-plane me-2"></i>Áp dụng khuyến mãi cho các sản phẩm đã chọn
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}

// Code phân loại sản phẩm theo thương hiệu
if(isset($_POST['th'])) {
    $mth = $_POST['th'];
    $sql = "SELECT * FROM sanpham WHERE MaNCC ='$mth'";
    $rs = mysqli_query($conn, $sql);
?>
<!-- Bảng dữ liệu sản phẩm theo thương hiệu với thiết kế mới -->
<div class="container-fluid px-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <?php
            $sql_brand = "SELECT * FROM nhacc WHERE MaNCC='$mth'";
            $rs_brand = mysqli_query($conn, $sql_brand);
            $row_brand = mysqli_fetch_array($rs_brand);
            ?>
            <h5 class="mb-0"><i class="fas fa-tag me-2"></i>Sản phẩm thương hiệu: <?php echo $row_brand['TenNCC']; ?></h5>
            <div>
                <button class="btn btn-sm btn-outline-primary me-2" type="button" id="btn1">
                    <i class="fas fa-check-square me-1"></i>Chọn tất cả
                </button>
                <button class="btn btn-sm btn-outline-secondary" type="button" id="btn2">
                    <i class="fas fa-square me-1"></i>Bỏ chọn
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <form action="khuyenmai/xuly.php" method="get" accept-charset="utf-8">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr class="bg-light">
                                <th class="text-center">Hình ảnh</th>
                                <th>Mã SP</th>
                                <th>Tên sản phẩm</th>
                                <th>Thương hiệu</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-center">Áp dụng</th>
                                <th class="text-center">Chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($rs)) {
                            $i += 1;
                            $mth = $row['MaNCC'];
                            $sql1 = "SELECT * FROM nhacc WHERE MaNCC='$mth'";
                            $rs1 = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_array($rs1);
                        ?>
                            <tr>
                                <td class="text-center">
                                    <img src="../webroot/image/sanpham/<?php echo $row['AnhNen']; ?>"
                                         class="img-thumbnail" width="60" height="50" alt="<?php echo $row['TenSP']; ?>">
                                </td>
                                <td><?php echo $row['MaSP']; ?></td>
                                <td><?php echo $row['TenSP']; ?></td>
                                <td><?php echo $row1['TenNCC']; ?></td>
                                <td class="text-end fw-bold"><?php echo number_format($row['DonGia']).' đ'; ?></td>
                                <td class="text-center">
                                    <a href="khuyenmai/xuly.php?masp=<?php echo $row['MaSP'] ?>&apply2&makm=<?php echo $id ?>"
                                       class="btn btn-sm btn-success">
                                        <i class="fas fa-check me-1"></i>Áp dụng
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="<?php echo $row['MaSP']; ?>"
                                               name="chon[]" value="<?php echo $row['MaSP']; ?>">
                                        <label class="form-check-label" for="<?php echo $row['MaSP']; ?>"></label>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="makm" value="<?php echo $id ?>">

                <div class="card-footer text-center py-3">
                    <button type="submit" name="apply" class="btn btn-primary px-4">
                        <i class="fas fa-paper-plane me-2"></i>Áp dụng khuyến mãi cho các sản phẩm đã chọn
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<!-- Thêm phần thông tin khuyến mãi -->
<?php
// Lấy thông tin chi tiết khuyến mãi
$sql_info = "SELECT * FROM khuyenmai WHERE MaKM = $id";
$rs_info = mysqli_query($conn, $sql_info);
$row_info = mysqli_fetch_array($rs_info);

if (!isset($_POST['btsearch']) && !isset($_POST['th'])) {
?>
<div class="container-fluid px-4 mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-primary h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Thông tin khuyến mãi</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tên khuyến mãi:
                            <span class="fw-bold"><?php echo $row_info['TenKM']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Phần trăm giảm giá:
                            <span class="badge bg-primary rounded-pill"><?php echo $row_info['KM_PT']; ?>%</span>
                        </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Tiền giảm giá:
                                                <span class="badge bg-primary rounded-pill"><?php echo $row_info['TienKM']; ?>Đ</span>
                                            </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Ngày bắt đầu:
                            <span class="text-success"><?php echo date('d/m/Y', strtotime($row_info['NgayBD'])); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Ngày kết thúc:
                            <span class="text-danger"><?php echo date('d/m/Y', strtotime($row_info['NgayKT'])); ?></span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="index.php?action=khuyenmai" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-1"></i>Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Hướng dẫn sử dụng</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Chọn một trong các cách sau để áp dụng khuyến mãi cho sản phẩm:
                    </div>

                    <div class="mb-3">
                        <h6 class="fw-bold"><i class="fas fa-search me-2"></i>Tìm kiếm sản phẩm</h6>
                        <p>Nhập tên sản phẩm vào ô tìm kiếm và nhấn nút "Tìm kiếm" để tìm sản phẩm cần áp dụng.</p>
                    </div>

                    <div class="mb-3">
                        <h6 class="fw-bold"><i class="fas fa-tags me-2"></i>Lọc theo thương hiệu</h6>
                        <p>Nhấn vào tên thương hiệu để hiển thị danh sách sản phẩm của thương hiệu đó.</p>
                    </div>

                    <div>
                        <h6 class="fw-bold"><i class="fas fa-check-square me-2"></i>Áp dụng khuyến mãi</h6>
                        <p>Có hai cách để áp dụng khuyến mãi:</p>
                        <ul>
                            <li>Nhấn nút "Áp dụng" bên cạnh sản phẩm để áp dụng riêng cho sản phẩm đó.</li>
                            <li>Tích chọn các sản phẩm cần áp dụng, sau đó nhấn nút "Áp dụng khuyến mãi cho các sản phẩm đã chọn" ở cuối trang.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Script JavaScript đã được cải thiện -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chức năng chọn hết
    document.getElementById("btn1").onclick = function() {
        // Lấy danh sách checkbox
        var checkboxes = document.getElementsByName('chon[]');
        // Lặp và thiết lập checked
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true;
        }
    };

    // Chức năng bỏ chọn hết
    document.getElementById("btn2").onclick = function() {
        // Lấy danh sách checkbox
        var checkboxes = document.getElementsByName('chon[]');
        // Lặp và thiết lập Uncheck
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false;
        }
    };
});
</script>