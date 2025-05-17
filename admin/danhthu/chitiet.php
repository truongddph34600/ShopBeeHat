<?php
// Kiểm tra kết nối database trước khi thực hiện truy vấn
if (!isset($conn) || !$conn) {
    die("Kết nối database thất bại. Vui lòng kiểm tra lại cấu hình.");
}

// Hàm bảo mật dữ liệu đầu vào
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
}

// Khởi tạo biến
$reportTitle = "Tổng quan Doanh thu";
$reportPeriod = "";
$reportData = [];
$totalRevenue = 0;

// Xử lý báo cáo theo tháng
if (isset($_GET['thang']) && isset($_GET['nam'])) {
    $thang = sanitize($conn, $_GET['thang']);
    $nam = sanitize($conn, $_GET['nam']);

    // Đảm bảo thang có định dạng 2 chữ số
    if ((int)$thang >= 1 && (int)$thang <= 9) {
        $thang = '0' . (int)$thang;
    }

    // Tạo chuỗi tìm kiếm an toàn
    $searchPeriod = "$nam-$thang-%";
    $reportPeriod = "Tháng $thang/$nam";

    // Sử dụng prepared statement thay vì nối chuỗi trực tiếp
    $sql = "SELECT * FROM `hoadon` WHERE NgayGiao LIKE ? AND TinhTrang='hoàn thành'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $searchPeriod);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Lấy dữ liệu
    while ($row = mysqli_fetch_assoc($result)) {
        $reportData[] = $row;
        $totalRevenue += $row['TongTien'];
    }
}

// Xử lý báo cáo theo khoảng thời gian
if (isset($_GET['tu']) && isset($_GET['den'])) {
    $tu = sanitize($conn, $_GET['tu']);
    $den = sanitize($conn, $_GET['den']);

    $reportPeriod = "Từ $tu đến $den";

    // Sử dụng prepared statement
    $sql = "SELECT * FROM `hoadon` WHERE NgayGiao BETWEEN ? AND ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $tu, $den);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Lấy dữ liệu
    while ($row = mysqli_fetch_assoc($result)) {
        $reportData[] = $row;
        $totalRevenue += $row['TongTien'];
    }
}

// Chuẩn bị dữ liệu cho biểu đồ
$chartData = [];
$chartLabels = [];

if (!empty($reportData)) {
    // Nhóm dữ liệu theo ngày
    $groupedByDate = [];

    foreach ($reportData as $row) {
        $date = substr($row['NgayGiao'], 0, 10);
        if (!isset($groupedByDate[$date])) {
            $groupedByDate[$date] = 0;
        }
        $groupedByDate[$date] += $row['TongTien'];
    }

    // Sắp xếp theo ngày
    ksort($groupedByDate);

    // Chuẩn bị dữ liệu cho biểu đồ
    foreach ($groupedByDate as $date => $amount) {
        $chartLabels[] = $date;
        $chartData[] = $amount;
    }
}

// Chuyển dữ liệu biểu đồ sang JSON để sử dụng trong JavaScript
$chartLabelsJSON = json_encode($chartLabels);
$chartDataJSON = json_encode($chartData);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Doanh thu</title>

    <!-- CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #224abe;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fc;
            color: #5a5c69;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 0.5rem;
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15);
            margin-bottom: 1.5rem;
            padding: 1.5rem;
        }

        .dashboard-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .card {
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15);
            border: none;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .table tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .table tbody td {
            padding: 0.75rem;
            vertical-align: middle;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .total-row {
            background-color: #f2f7ff;
            font-weight: 700;
            color: var(--danger-color);
            font-size: 1.2rem;
        }

        .chart-container {
            height: 300px;
            margin-bottom: 1rem;
        }

        .badge-status {
            padding: 0.4rem 0.6rem;
            border-radius: 0.25rem;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item i {
            margin: 0 0.5rem;
        }

        .stats-card {
            border-left: 0.25rem solid var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .stats-card.total {
            border-left-color: var(--success-color);
        }

        .stats-card.orders {
            border-left-color: var(--info-color);
        }

        .stats-card-body {
            padding: 1.25rem;
        }

        .stats-card-heading {
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: var(--primary-color);
        }

        .stats-card-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0;
        }

        .stats-card.total .stats-card-heading {
            color: var(--success-color);
        }

        .stats-card.orders .stats-card-heading {
            color: var(--info-color);
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.25rem;
            color: white;
            margin-right: 0.25rem;
            transition: all 0.15s;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .action-btn.view {
            background-color: var(--info-color);
        }

        .action-btn.view:hover {
            background-color: #2a93a3;
        }

        @media (max-width: 768px) {
            .table {
                font-size: 0.8rem;
            }

            .dashboard-header h4 {
                font-size: 1.2rem;
            }

            .stats-card-value {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid py-4">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="page-title mb-1">
                    <i class="fas fa-chart-line me-2"></i> Quản lý Doanh thu
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="background: transparent;">
                        <li class="breadcrumb-item text-white-50"><i class="fas fa-home"></i> ADMIN</li>
                        <li class="breadcrumb-item text-white-50">Doanh Thu</li>
                        <li class="breadcrumb-item active text-white" aria-current="page"><?php echo $reportPeriod; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Total Revenue Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card total">
                <div class="stats-card-body">
                    <div class="stats-card-heading">Tổng doanh thu</div>
                    <div class="stats-card-value"><?php echo number_format($totalRevenue) . ' đ'; ?></div>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card orders">
                <div class="stats-card-body">
                    <div class="stats-card-heading">Số đơn hàng</div>
                    <div class="stats-card-value"><?php echo count($reportData); ?></div>
                </div>
            </div>
        </div>

        <!-- Average Order Value Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card">
                <div class="stats-card-body">
                    <div class="stats-card-heading">Giá trị TB / đơn</div>
                    <div class="stats-card-value">
                        <?php
                        $avgOrderValue = count($reportData) > 0 ? $totalRevenue / count($reportData) : 0;
                        echo number_format($avgOrderValue) . ' đ';
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Period Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card">
                <div class="stats-card-body">
                    <div class="stats-card-heading">Kỳ báo cáo</div>
                    <div class="stats-card-value" style="font-size: 1.2rem;">
                        <?php echo $reportPeriod; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <?php if (!empty($reportData)): ?>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-chart-bar me-2"></i> Biểu đồ doanh thu: <?php echo $reportPeriod; ?></span>
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-primary active" id="viewBar">
                    <i class="fas fa-chart-bar"></i>
                </button>
                <button type="button" class="btn btn-sm btn-outline-primary" id="viewLine">
                    <i class="fas fa-chart-line"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Data Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-table me-2"></i> Danh sách hóa đơn: <?php echo $reportPeriod; ?></span>
        </div>
        <div class="card-body">
            <?php if (!empty($reportData)): ?>
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th>Mã HD</th>
                                <th>Mã KH</th>
                                <th>Mã NV</th>
                                <th>Ngày đặt</th>
                                <th>Ngày giao</th>
                                <th>Tổng tiền</th>
                                <th>Tình trạng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reportData as $row): ?>
                                <tr>
                                    <td><?php echo $row['MaHD']; ?></td>
                                    <td><?php echo $row['MaKH']; ?></td>
                                    <td><?php echo $row['MaNV']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['NgayDat'])); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['NgayGiao'])); ?></td>
                                    <td class="text-end"><?php echo number_format($row['TongTien']) . ' đ'; ?></td>
                                    <td>
                                        <span class="badge bg-success badge-status">
                                            <i class="fas fa-check-circle me-1"></i>
                                            <?php echo $row['TinhTrang']; ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="index.php?action=xldathang&view=ctdh&mahd=<?php echo $row['MaHD']; ?>"
                                           class="action-btn view" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="5" class="text-end">Tổng doanh thu:</td>
                                <td colspan="3" class="text-start"><?php echo number_format($totalRevenue) . ' đ'; ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> Không có dữ liệu doanh thu cho khoảng thời gian này.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="filterModalLabel">
                    <i class="fas fa-filter me-2"></i> Lọc báo cáo doanh thu
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="filterTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="month-tab" data-bs-toggle="tab" data-bs-target="#month" type="button" role="tab">
                            <i class="fas fa-calendar-alt me-1"></i> Theo tháng
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="range-tab" data-bs-toggle="tab" data-bs-target="#range" type="button" role="tab">
                            <i class="fas fa-calendar-week me-1"></i> Theo khoảng thời gian
                        </button>
                    </li>
                </ul>
                <div class="tab-content pt-3" id="filterTabContent">
                    <!-- Month Filter -->
                    <div class="tab-pane fade show active" id="month" role="tabpanel" aria-labelledby="month-tab">
                        <form action="index.php" method="GET">
                            <input type="hidden" name="action" value="thongke">
                            <input type="hidden" name="view" value="doanhthu">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="thang" class="form-label">Tháng</label>
                                    <select class="form-select" id="thang" name="thang" required>
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nam" class="form-label">Năm</label>
                                    <select class="form-select" id="nam" name="nam" required>
                                        <?php for ($i = date('Y'); $i >= 2020; $i--): ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search me-1"></i> Xem báo cáo
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Date Range Filter -->
                    <div class="tab-pane fade" id="range" role="tabpanel" aria-labelledby="range-tab">
                        <form action="index.php" method="GET">
                            <input type="hidden" name="action" value="thongke">
                            <input type="hidden" name="view" value="doanhthu">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tu" class="form-label">Từ ngày</label>
                                    <input type="date" class="form-control" id="tu" name="tu" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="den" class="form-label">Đến ngày</label>
                                    <input type="date" class="form-control" id="den" name="den" required>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search me-1"></i> Xem báo cáo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap & jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Charts Setup -->
<script>
    // Kiểm tra nếu có dữ liệu biểu đồ
    <?php if (!empty($chartLabels) && !empty($chartData)): ?>

    // Dữ liệu biểu đồ
    const chartLabels = <?php echo $chartLabelsJSON; ?>;
    const chartData = <?php echo $chartDataJSON; ?>;

    // Format các ngày cho dễ đọc
    const formattedLabels = chartLabels.map(date => {
        const dateObj = new Date(date);
        return dateObj.getDate() + '/' + (dateObj.getMonth() + 1);
    });

    // Cấu hình biểu đồ
    const chartConfig = {
        type: 'bar',
        data: {
            labels: formattedLabels,
            datasets: [{
                label: 'Doanh thu (đ)',
                data: chartData,
                backgroundColor: 'rgba(78, 115, 223, 0.6)',
                borderColor: '#4e73df',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('vi-VN').format(context.parsed.y) + ' đ';
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN').format(value) + ' đ';
                        }
                    }
                }
            }
        }
    };

    // Khởi tạo biểu đồ
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, chartConfig);

    // Xử lý chuyển đổi kiểu biểu đồ
    document.getElementById('viewBar').addEventListener('click', function() {
        revenueChart.config.type = 'bar';
        revenueChart.update();

        document.getElementById('viewBar').classList.add('active');
        document.getElementById('viewLine').classList.remove('active');
    });

    document.getElementById('viewLine').addEventListener('click', function() {
        revenueChart.config.type = 'line';
        revenueChart.update();

        document.getElementById('viewLine').classList.add('active');
        document.getElementById('viewBar').classList.remove('active');
    });
    <?php endif; ?>

    // Xử lý xuất báo cáo
    document.getElementById('exportExcel').addEventListener('click', function() {
        alert('Chức năng xuất Excel đang được phát triển');
    });

    document.getElementById('exportPDF').addEventListener('click', function() {
        alert('Chức năng xuất PDF đang được phát triển');
    });
</script>

</body>
</html>