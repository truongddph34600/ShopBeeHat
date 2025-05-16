<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Khách Hàng</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap5.min.css" />
    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .page-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(78, 115, 223, 0.15);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }
        .page-title-icon {
            height: 40px;
            width: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 30px;
        }
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-title {
            color: #5a5c69;
            font-weight: 700;
            margin-bottom: 0;
        }
        .customer-count {
            background-color: #4e73df;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            margin-left: 10px;
        }
        .table-container {
            padding: 1.5rem;
        }
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.5;
            color: #6e707e;
            background-color: #fff;
            background-clip: padding-box;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            outline: 0;
        }
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            padding: 0.375rem 1.75rem 0.375rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.5;
            color: #6e707e;
            background-color: #fff;
        }
        table.dataTable {
            border-collapse: collapse !important;
            width: 100% !important;
        }
        table.dataTable thead {
            background-color: #4e73df;
            color: white;
        }
        table.dataTable thead th {
            padding: 15px 10px;
            border-bottom: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }
        table.dataTable tbody tr:nth-of-type(odd) {
            background-color: #f8f9fc;
        }
        table.dataTable tbody tr:hover {
            background-color: #eaecf4;
        }
        table.dataTable tbody td {
            padding: 15px 10px;
            vertical-align: middle;
            font-size: 0.875rem;
            border-top: 1px solid #e3e6f0;
        }
        .customer-name {
            font-weight: 600;
            color: #4e73df;
            display: flex;
            align-items: center;
        }
        .customer-avatar {
            width: 35px;
            height: 35px;
            background-color: #4e73df;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 600;
        }
        .badge-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .badge-active {
            background-color: #1cc88a;
            color: white;
        }
        .dataTables_info {
            padding: 1rem;
            font-size: 0.875rem;
            color: #858796;
        }
        .page-item.active .page-link {
            background-color: #4e73df;
            border-color: #4e73df;
        }
        .page-link {
            color: #4e73df;
        }
        .action-btn {
            padding: 6px;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            margin-right: 5px;
        }
        .btn-view {
            background-color: #4e73df;
            color: white;
        }
        .btn-edit {
            background-color: #1cc88a;
            color: white;
        }
        .btn-delete {
            background-color: #e74a3b;
            color: white;
        }
        .action-btn:hover {
            opacity: 0.8;
            transform: translateY(-2px);
        }
        .table-responsive {
            overflow-x: auto;
        }
        .custom-info {
            display: flex;
            align-items: center;
        }
        .contact-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: #f1f3ff;
            color: #4e73df;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-size: 12px;
        }
        .filter-section {
            padding: 0 1.5rem 1.5rem 1.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .filter-item {
            flex: 1;
            min-width: 200px;
        }
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                text-align: center;
            }
            .page-title-icon {
                margin-bottom: 10px;
                margin-right: 0;
            }
        }
    </style>
</head>
<body>

<?php
include_once('../model/database.php');
    $sql = "SELECT * FROM khachhang";
    $rs = mysqli_query($conn, $sql);
    $customer_count = mysqli_num_rows($rs);
?>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-title-icon">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <h4 class="m-0 font-weight-bold">Quản Lý Khách Hàng</h4>

        </div>
    </div>

    <!-- Customer List Card -->
    <div class="card">
        <!-- Card Header -->
        <div class="card-header">
            <h5 class="card-title">
                <i class="fas fa-list me-2"></i>
                Danh Sách Khách Hàng
                <span class="customer-count"><?php echo $customer_count; ?> khách hàng</span>
            </h5>
            <div>
                <button class="btn btn-sm btn-success ms-2">
                    <i class="fas fa-plus me-1"></i> Thêm Khách Hàng
                </button>
            </div>
        </div>
        <!-- Table Container -->
        <div class="table-container">
            <div class="table-responsive">
                <table id="customerTable" class="table table-hover display nowrap">
                    <thead>
                        <tr>
                            <th>Mã KH</th>
                            <th>Khách Hàng</th>
                            <th>Email</th>
                            <th>Số Điện Thoại</th>
                            <th>Địa Chỉ</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($row = mysqli_fetch_array($rs)) {
                            // Get initials for avatar
                            $initials = strtoupper(substr($row['TenKH'], 0, 1));
                    ?>
                        <tr>
                            <td><?php echo $row['MaKH']; ?></td>
                            <td>
                                <div class="customer-name">
                                    <div class="customer-avatar"><?php echo $initials; ?></div>
                                    <?php echo $row['TenKH']; ?>
                                </div>
                            </td>
                            <td>
                                <div class="custom-info">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <?php echo $row['Email']; ?>
                                </div>
                            </td>
                            <td>
                                <div class="custom-info">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <?php echo $row['SDT']; ?>
                                </div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 200px;" title="<?php echo $row['DiaChi']; ?>">
                                    <i class="fas fa-map-marker-alt me-1 text-secondary"></i>
                                    <?php echo $row['DiaChi']; ?>
                                </div>
                            </td>
                            <td>
                                <span class="badge-status badge-active">Hoạt động</span>
                            </td>
                            <td>
                                <a href="#" class="action-btn btn-view" title="Xem chi tiết">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="action-btn btn-edit" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="action-btn btn-delete" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- DataTables -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#customerTable').DataTable({
        language: {
            search: "Tìm kiếm:",
            lengthMenu: "Hiển thị _MENU_ khách hàng",
            zeroRecords: "Không tìm thấy khách hàng nào phù hợp",
            info: "Hiển thị _START_ đến _END_ của _TOTAL_ khách hàng",
            infoEmpty: "Không có khách hàng nào",
            infoFiltered: "(lọc từ _MAX_ khách hàng)",
            paginate: {
                first: "Đầu",
                last: "Cuối",
                next: "Sau",
                previous: "Trước"
            }
        },
        responsive: true,
        pageLength: 10,
        dom: '<"top"fl>rt<"bottom"ip><"clear">',
        columnDefs: [
            { orderable: false, targets: 6 } // Disable sorting on action column
        ]
    });

    // Apply search
    $('#status-filter, #sort-by, #time-filter').on('change', function() {
        // Here you would normally implement server-side filtering
        // For demo, we'll just reset the table
        table.draw();
    });

    // Hover effect for table rows
    $('#customerTable tbody').on('mouseenter', 'tr', function() {
        $(this).addClass('highlight');
    }).on('mouseleave', 'tr', function() {
        $(this).removeClass('highlight');
    });

    // Tooltip initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
</body>
</html>