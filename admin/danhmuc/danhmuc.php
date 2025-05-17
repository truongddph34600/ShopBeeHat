<?php
    include_once('../model/database.php');
    // Sửa lại câu truy vấn để xem cấu trúc bảng
    $sql = "DESCRIBE nhacc";
    $structure = mysqli_query($conn, $sql);

    // Lấy tên thực tế của các cột
    $idColumn = "MaNCC"; // Giá trị mặc định
    $nameColumn = "TenNCC"; // Giá trị mặc định

    // Kiểm tra tên cột thực tế
    while ($field = mysqli_fetch_array($structure)) {
        if (strpos(strtolower($field['Field']), 'ma') !== false ||
            strpos(strtolower($field['Field']), 'id') !== false) {
            $idColumn = $field['Field'];
        }
        if (strpos(strtolower($field['Field']), 'ten') !== false ||
            strpos(strtolower($field['Field']), 'name') !== false) {
            $nameColumn = $field['Field'];
        }
    }

    // Lấy dữ liệu từ bảng nhacc
    $sql = "SELECT * FROM nhacc";
    $rs = mysqli_query($conn, $sql);

    // Debugging - hiển thị tên cột
    $debug = false; // Đặt thành true nếu muốn xem tên thực tế của các cột
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Danh Mục</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .dashboard-header {
            background: linear-gradient(to right, #4e73df, #224abe);
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 25px;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            color: white;
        }

        .action-btns {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .action-btn {
            border-radius: 5px;
            padding: 5px 15px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .add-btn {
            background-color: #36b9cc;
            color: white;
            border-radius: 5px;
            padding: 8px 15px;
            font-weight: 500;
            margin-bottom: 15px;
            transition: all 0.3s;
            border: none;
        }

        .add-btn:hover {
            background-color: #2c9faf;
            transform: translateY(-2px);
        }

        .table-container {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.1);
        }

        .badge-count {
            background-color: #e74a3b;
            color: white;
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 0.8rem;
        }

        .edit-btn {
            color: #1cc88a;
            transition: all 0.2s;
        }

        .edit-btn:hover {
            color: #169d6b;
            transform: scale(1.1);
        }

        .delete-btn {
            color: #e74a3b;
            transition: all 0.2s;
        }

        .delete-btn:hover {
            color: #be2617;
            transform: scale(1.1);
        }

        .form-section {
            background-color: #f8f9fc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background-color: #4e73df;
            color: white;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="dashboard-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0">
                    <i class="fas fa-folder me-2"></i> Quản lý Danh Mục
                </h4>
            </div>
            <div>
                <span class="badge badge-count">
                    <i class="fas fa-list me-1"></i> <span id="totalItems">0</span> danh mục
                </span>
            </div>
        </div>
    </div>

    <!-- Debug Info (chỉ hiển thị khi cần) -->
    <?php if ($debug): ?>
    <div class="alert alert-info">
        <h5>Thông tin debug:</h5>
        <p>ID Column: <?php echo $idColumn; ?></p>
        <p>Name Column: <?php echo $nameColumn; ?></p>
        <p>Cấu trúc bảng:</p>
        <ul>
            <?php
            mysqli_data_seek($structure, 0);
            while ($field = mysqli_fetch_array($structure)) {
                echo "<li>" . $field['Field'] . " - " . $field['Type'] . "</li>";
            }
            ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- Form Section -->
    <div class="form-section">
        <?php include_once('danhmuc/main.php');?>
    </div>

    <!-- Data Table -->
    <div class="card">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Danh Mục</h6>

        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table table-hover table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th style="width: 30%">Mã Danh Mục</th>
                            <th style="width: 50%">Tên Danh Mục</th>
                            <th style="width: 20%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $so = 0;
                        while ($row = mysqli_fetch_array($rs)) {
                            $so++;
                            // Sử dụng tên cột động từ việc kiểm tra cấu trúc bảng
                        ?>
                        <tr>
                            <td><?php echo isset($row[$idColumn]) ? $row[$idColumn] : "N/A"; ?></td>
                            <td><?php echo isset($row[$nameColumn]) ? $row[$nameColumn] : "N/A"; ?></td>
                            <td>
                                <div class="action-btns">
                                    <a href="index.php?action=danhmuc&view=suadm&madm=<?php echo isset($row[$idColumn]) ? $row[$idColumn] : ""; ?>"
                                        class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <a href="danhmuc/main.php?view=xoadm&madm=<?php echo isset($row[$idColumn]) ? $row[$idColumn] : ""; ?>"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS và dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    // Cập nhật số lượng danh mục
    document.addEventListener('DOMContentLoaded', function() {
        const totalRows = document.querySelectorAll('#dataTable tbody tr').length;
        document.getElementById('totalItems').textContent = totalRows;
    });
</script>
</body>
</html>