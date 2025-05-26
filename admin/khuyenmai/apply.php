<?php 
    // Get promotion ID and validate
    $id = isset($_GET['makm']) ? intval($_GET['makm']) : 0;
    if ($id <= 0) {
        // Invalid ID, redirect back to promotion list
        header('location: index.php?action=khuyenmai&thongbao=loi');
        exit;
    }

    // Fetch promotion details
    $sql_sua = "SELECT * FROM `khuyenmai` WHERE MaKM=$id";
    $rs_sua = mysqli_query($conn, $sql_sua);

    if (!$rs_sua || mysqli_num_rows($rs_sua) == 0) {
        // Promotion not found, redirect back
        header('location: index.php?action=khuyenmai&thongbao=loi');
        exit;
    }

    $kq = mysqli_fetch_array($rs_sua);

    // Get list of products already having this promotion
    $applied_products = [];
    $sql_applied = "SELECT MaSP FROM sanphamkhuyenmai WHERE MaKM=$id";
    $rs_applied = mysqli_query($conn, $sql_applied);
    if ($rs_applied && mysqli_num_rows($rs_applied) > 0) {
        while ($row_applied = mysqli_fetch_array($rs_applied)) {
            $applied_products[] = $row_applied['MaSP'];
        }
    }
?>

<!-- Success/Error notifications -->
<?php if (isset($_GET['thongbao'])): ?>
    <div class="alert alert-dismissible fade show <?php echo ($_GET['thongbao'] == 'them') ? 'alert-success' : 'alert-danger'; ?>" role="alert">
        <?php
            switch ($_GET['thongbao']) {
                case 'them':
                    echo '<i class="fas fa-check-circle me-2"></i>Áp dụng khuyến mãi thành công!';
                    break;
                case 'loi':
                    echo '<i class="fas fa-exclamation-triangle me-2"></i>Có lỗi xảy ra, vui lòng thử lại!';
                    break;
                case 'loi-chon':
                    echo '<i class="fas fa-exclamation-triangle me-2"></i>Vui lòng chọn ít nhất một sản phẩm!';
                    break;
                case 'da-km':
                    echo '<i class="fas fa-info-circle me-2"></i>Sản phẩm đã được áp dụng khuyến mãi này!';
                    break;
            }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Phần header với thiết kế mới -->
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-percent me-2"></i>Mã KM :
            <?php echo htmlspecialchars($kq['TenKM']); ?>
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
                        <i class="fas fa-search me-1"></i>Tìm kiếm
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
                        <?php echo htmlspecialchars($row['TenNCC']); ?>
                    </button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Code tìm kiếm
if(isset($_POST['btsearch'])) {
    $tk = trim(mysqli_real_escape_string($conn, $_POST['tk']));
    if (empty($tk)) {
        echo '<div class="alert alert-warning">Vui lòng nhập từ khóa tìm kiếm!</div>';
    } else {
        $sql = "SELECT * FROM sanpham WHERE TenSP LIKE N'%$tk%' ORDER BY MaNCC DESC";
        $rs = mysqli_query($conn, $sql);
        $num_results = mysqli_num_rows($rs);
?>
<!-- Bảng dữ liệu sản phẩm với thiết kế mới -->
<div class="container-fluid px-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-search me-2"></i>Kết quả tìm kiếm
                <span class="badge bg-primary"><?php echo $num_results; ?> sản phẩm</span>
            </h5>
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
            <form action="khuyenmai/xuly.php" method="get" accept-charset="utf-8" id="applyForm">
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
                        if ($num_results > 0) {
                            while ($row = mysqli_fetch_array($rs)) {
                                $i += 1;
                                $mth = $row['MaNCC'];
                                $sql1 = "SELECT * FROM nhacc WHERE MaNCC='$mth'";
                                $rs1 = mysqli_query($conn, $sql1);
                                $row1 = mysqli_fetch_array($rs1);
                                $already_applied = in_array($row['MaSP'], $applied_products);
                        ?>
                            <tr <?php echo $already_applied ? 'class="table-success"' : ''; ?>>
                                <td class="text-center">
                                    <img src="../webroot/image/sanpham/<?php echo htmlspecialchars($row['AnhNen']); ?>"
                                         class="img-thumbnail" width="60" height="50" alt="<?php echo htmlspecialchars($row['TenSP']); ?>">
                                </td>
                                <td><?php echo htmlspecialchars($row['MaSP']); ?></td>
                                <td><?php echo htmlspecialchars($row['TenSP']); ?></td>
                                <td><?php echo htmlspecialchars($row1['TenNCC']); ?></td>
                                <td class="text-end fw-bold"><?php echo number_format($row['DonGia']).' đ'; ?></td>
                                <td class="text-center">
                                    <?php if ($already_applied): ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Đã áp dụng
                                        </span>
                                    <?php else: ?>
                                        <a href="khuyenmai/xuly.php?masp=<?php echo urlencode($row['MaSP']); ?>&apply2&makm=<?php echo $id ?>"
                                           class="btn btn-sm btn-success">
                                            <i class="fas fa-check me-1"></i>Áp dụng
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="<?php echo $row['MaSP']; ?>"
                                               name="chon[]" value="<?php echo htmlspecialchars($row['MaSP']); ?>"
                                               <?php echo $already_applied ? 'disabled checked' : ''; ?>>
                                        <label class="form-check-label" for="<?php echo $row['MaSP']; ?>"></label>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="7" class="text-center py-3">Không tìm thấy sản phẩm phù hợp!</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="makm" value="<?php echo $id ?>">

                <?php if ($num_results > 0): ?>
                <div class="card-footer text-center py-3">
                    <button type="submit" name="apply" class="btn btn-primary px-4" id="applyButton">
                        <i class="fas fa-paper-plane me-2"></i>Áp dụng khuyến mãi cho các sản phẩm đã chọn
                    </button>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php
    }
}

// Code phân loại sản phẩm theo thương hiệu
if(isset($_POST['th'])) {
    $mth = intval($_POST['th']);
    $sql = "SELECT * FROM sanpham WHERE MaNCC ='$mth'";
    $rs = mysqli_query($conn, $sql);
    $num_results = mysqli_num_rows($rs);
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
            <h5 class="mb-0">
                <i class="fas fa-tag me-2"></i>Sản phẩm thương hiệu: <?php echo htmlspecialchars($row_brand['TenNCC']); ?>
                <span class="badge bg-primary"><?php echo $num_results; ?> sản phẩm</span>
            </h5>
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
            <form action="khuyenmai/xuly.php" method="get" accept-charset="utf-8" id="applyForm">
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
                        if ($num_results > 0) {
                            while ($row = mysqli_fetch_array($rs)) {
                                $i += 1;
                                $mth = $row['MaNCC'];
                                $sql1 = "SELECT * FROM nhacc WHERE MaNCC='$mth'";
                                $rs1 = mysqli_query($conn, $sql1);
                                $row1 = mysqli_fetch_array($rs1);
                                $already_applied = in_array($row['MaSP'], $applied_products);
                        ?>
                            <tr <?php echo $already_applied ? 'class="table-success"' : ''; ?>>
                                <td class="text-center">
                                    <img src="../webroot/image/sanpham/<?php echo htmlspecialchars($row['AnhNen']); ?>"
                                         class="img-thumbnail" width="60" height="50" alt="<?php echo htmlspecialchars($row['TenSP']); ?>">
                                </td>
                                <td><?php echo htmlspecialchars($row['MaSP']); ?></td>
                                <td><?php echo htmlspecialchars($row['TenSP']); ?></td>
                                <td><?php echo htmlspecialchars($row1['TenNCC']); ?></td>
                                <td class="text-end fw-bold"><?php echo number_format($row['DonGia']).' đ'; ?></td>
                                <td class="text-center">
                                    <?php if ($already_applied): ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Đã áp dụng
                                        </span>
                                    <?php else: ?>
                                        <a href="khuyenmai/xuly.php?masp=<?php echo urlencode($row['MaSP']); ?>&apply2&makm=<?php echo $id ?>"
                                           class="btn btn-sm btn-success">
                                            <i class="fas fa-check me-1"></i>Áp dụng
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="<?php echo $row['MaSP']; ?>"
                                               name="chon[]" value="<?php echo htmlspecialchars($row['MaSP']); ?>"
                                               <?php echo $already_applied ? 'disabled checked' : ''; ?>>
                                        <label class="form-check-label" for="<?php echo $row['MaSP']; ?>"></label>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="7" class="text-center py-3">Không có sản phẩm nào thuộc thương hiệu này!</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="makm" value="<?php echo $id ?>">

                <?php if ($num_results > 0): ?>
                <div class="card-footer text-center py-3">
                    <button type="submit" name="apply" class="btn btn-primary px-4" id="applyButton">
                        <i class="fas fa-paper-plane me-2"></i>Áp dụng khuyến mãi cho các sản phẩm đã chọn
                    </button>
                </div>
                <?php endif; ?>
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
                            <span class="fw-bold"><?php echo htmlspecialchars($row_info['TenKM']); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Phần trăm giảm giá:
                            <span class="badge bg-primary rounded-pill"><?php echo $row_info['KM_PT']; ?>%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tiền giảm giá:
                            <span class="badge bg-primary rounded-pill"><?php echo number_format($row_info['TienKM']); ?>đ</span>
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
            if (!checkboxes[i].disabled) {
                checkboxes[i].checked = true;
            }
        }
    };

    // Chức năng bỏ chọn hết
    document.getElementById("btn2").onclick = function() {
        // Lấy danh sách checkbox
        var checkboxes = document.getElementsByName('chon[]');
        // Lặp và thiết lập Uncheck
        for (var i = 0; i < checkboxes.length; i++) {
            if (!checkboxes[i].disabled) {
                checkboxes[i].checked = false;
            }
        }
    };

    // Form validation
    var form = document.getElementById('applyForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            var checkboxes = document.getElementsByName('chon[]');
            var isChecked = false;

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked && !checkboxes[i].disabled) {
                    isChecked = true;
                    break;
                }
            }

            if (!isChecked) {
                event.preventDefault();
                alert('Vui lòng chọn ít nhất một sản phẩm để áp dụng khuyến mãi!');
            }
        });
    }

    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>