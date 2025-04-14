<?php
    $sql = "SELECT * FROM khuyenmai";
    $rs = mysqli_query($conn, $sql);
?>

<div class="container-fluid mt-3">
    <!-- Tiêu đề -->
    <div class="alert alert-primary d-flex justify-content-between align-items-center">
        <h4 class="mb-0">
            <i class="fas fa-tags"></i> Danh sách khuyến mãi
        </h4>
        <a href="index.php?action=khuyenmai&view=them" class="btn btn-success btn-sm">
            <i class="fas fa-plus"></i> Thêm khuyến mãi
        </a>
    </div>

    <!-- Bảng danh sách -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered text-center">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Mã KM</th>
                        <th>Tên khuyến mãi</th>
                        <th>%</th>
                        <th>Giá</th>
                        <th>Mô Tả</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th colspan="3">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($rs)) { ?>
                        <tr>
                            <td><?= $row['MaKM'] ?></td>
                            <td><?= $row['TenKM'] ?></td>
                            <td><?= $row['KM_PT'] ?>%</td>
                            <td><?= number_format($row['TienKM']) . ' đ' ?></td>
                            <td><?= $row['MoTa'] ?></td>
                            <td><?= date('d/m/Y', strtotime($row['NgayBD'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($row['NgayKT'])) ?></td>
                            <td>
                                <a href="index.php?action=khuyenmai&view=sua&makm=<?= $row['MaKM'] ?>" 
                                   title="Sửa khuyến mãi">
                                   <i class="far fa-edit text-primary"></i>
                                </a>
                            </td>
                            <td>
                                <a href="index.php?action=khuyenmai&view=apply&makm=<?= $row['MaKM'] ?>" 
                                   title="Áp dụng khuyến mãi">
                                   <i class="fas fa-check-circle text-success"></i>
                                </a>
                            </td>
                            <td>
                                <a href="khuyenmai/xuly.php?xoa=xoa&makm=<?= $row['MaKM'] ?>" 
                                   onclick="return confirm('Bạn có chắc muốn xóa khuyến mãi này không?')" 
                                   title="Xóa khuyến mãi">
                                   <i class="fas fa-trash-alt text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
