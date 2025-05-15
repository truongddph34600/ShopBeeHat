<?php
    $sql = "SELECT * FROM khuyenmai";
    $rs = mysqli_query($conn, $sql);
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Quản Lý Khuyến Mãi</h5>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Mã KM</th>
                                    <th>Tên khuyến mãi</th>
                                    <th>%</th>
                                    <th>Giá</th>
                                    <th>Mô Tả</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (mysqli_num_rows($rs) > 0) {
                                while ($row = mysqli_fetch_array($rs)) {
                                    // Kiểm tra trạng thái khuyến mãi (đang chạy, sắp tới, đã kết thúc)
                                    $today = date('Y-m-d');
                                    $status = '';
                                    $statusClass = '';

                                    if ($today < $row['NgayBD']) {
                                        $status = 'Sắp tới';
                                        $statusClass = 'bg-info text-white';
                                    } elseif ($today > $row['NgayKT']) {
                                        $status = 'Đã kết thúc';
                                        $statusClass = 'bg-secondary text-white';
                                    } else {
                                        $status = 'Đang chạy';
                                        $statusClass = 'bg-success text-white';
                                    }
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['MaKM']); ?></td>
                                    <td>
                                        <span class="fw-medium"><?php echo htmlspecialchars($row['TenKM']); ?></span>
                                        <span class="badge rounded-pill <?php echo $statusClass; ?> ms-1"><?php echo $status; ?></span>
                                    </td>
                                    <td>
                                        <?php if ($row['KM_PT'] > 0) { ?>
                                            <span class="badge bg-success"><?php echo $row['KM_PT']; ?>%</span>
                                        <?php } else { ?>
                                            <span>-</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($row['TienKM'] > 0) { ?>
                                            <span class="text-danger fw-medium"><?php echo number_format($row['TienKM']); ?> đ</span>
                                        <?php } else { ?>
                                            <span>-</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php
                                        $mota = htmlspecialchars($row['MoTa']);
                                        if (strlen($mota) > 50) {
                                            echo '<span data-bs-toggle="tooltip" title="' . $mota . '">' . substr($mota, 0, 50) . '...</span>';
                                        } else {
                                            echo $mota;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo date('d/m/Y', strtotime($row['NgayBD'])); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['NgayKT'])); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="index.php?action=khuyenmai&view=apply&makm=<?php echo urlencode($row['MaKM']); ?>"
                                               class="btn btn-primary btn-sm me-1" data-bs-toggle="tooltip" title="Áp dụng">
                                                <i class="fas fa-check-circle"></i>
                                            </a>
                                            <a href="index.php?action=khuyenmai&view=sua&makm=<?php echo urlencode($row['MaKM']); ?>"
                                               class="btn btn-warning btn-sm me-1" data-bs-toggle="tooltip" title="Sửa">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" onclick="confirmDelete('<?php echo urlencode($row['MaKM']); ?>')"
                                               class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Xóa">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="8" class="text-center">Không có dữ liệu khuyến mãi</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal xác nhận xóa -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa khuyến mãi này không? Hành động này không thể hoàn tác.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Xóa</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Khởi tạo tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Hàm xác nhận xóa
    function confirmDelete(maKM) {
        var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        document.getElementById('confirmDeleteBtn').href = 'khuyenmai/xuly.php?xoa=xoa&makm=' + maKM;
        modal.show();
    }
</script>