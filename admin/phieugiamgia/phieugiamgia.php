<?php
    $sql = "SELECT * FROM phieugiamgia";
    $rs = mysqli_query($conn, $sql);
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Quản Lý Voucher</h5>
                </div>
                <div class="card-body">
                    <a href="?action=phieugiamgia&view=them" class="btn btn-add">
                                    <i class="fas fa-user-plus mr-2"></i>Thêm Voucher
                                </a>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Voucher</th>
                                    <th>Giá</th>
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
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['MaGG']); ?></td>
                                    <td>
                                        <span class="fw-medium"><?php echo htmlspecialchars($row['TenGG']); ?></span>
                                        <span class="badge rounded-pill <?php echo $statusClass; ?> ms-1"><?php echo $status; ?></span>
                                    </td>
                                    <td>
                                        <?php if ($row['TienGG'] > 0) { ?>
                                            <span class="text-danger fw-medium"><?php echo number_format($row['TienGG']); ?> đ</span>
                                        <?php } else { ?>
                                            <span>-</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="index.php?action=phieugiamgia&view=sua&id=<?php echo urlencode($row['MaGG']); ?>"
                                               class="btn btn-warning btn-sm me-1" data-bs-toggle="tooltip" title="Sửa">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" onclick="confirmDelete('<?php echo urlencode($row['MaGG']); ?>')"
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
    function confirmDelete(MaGG) {
        var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        document.getElementById('confirmDeleteBtn').href = 'phieugiamgia/xuly.php?xoa=xoa&MaGG=' + MaGG;
        modal.show();
    }
</script>