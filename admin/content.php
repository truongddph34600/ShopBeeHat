<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$date = getdate();
$thang = $date['year'].'-'.$date['mon'];
$nam = $date['year'];

// Query doanh thu tháng
$sql_dtt = "SELECT SUM(TongTien) as total, COUNT(*) as orders
            FROM hoadon
            WHERE TinhTrang='hoàn thành'
            AND YEAR(NgayGiao) = YEAR(CURRENT_DATE)
            AND MONTH(NgayGiao) = MONTH(CURRENT_DATE)";
$rs = mysqli_query($conn, $sql_dtt) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($rs);
$danhthuthang = $row['total'] ?? 0;
$order = $row['orders'] ?? 0;

// Query doanh thu năm
$sql_dtn = "SELECT SUM(TongTien) as total
            FROM hoadon
            WHERE TinhTrang='hoàn thành'
            AND YEAR(NgayGiao) = YEAR(CURRENT_DATE)";
$rsn = mysqli_query($conn, $sql_dtn) or die(mysqli_error($conn));
$rown = mysqli_fetch_assoc($rsn);
$danhthunam = $rown['total'] ?? 0;

// Dữ liệu cho biểu đồ cột
$sql_chart = "SELECT
    MONTH(NgayGiao) as Thang,
    SUM(TongTien) as DoanhThu
    FROM hoadon
    WHERE TinhTrang='hoàn thành'
    AND YEAR(NgayGiao) = '$nam'
    GROUP BY MONTH(NgayGiao)";
$rs_chart = mysqli_query($conn, $sql_chart);
$doanhThuTheoThang = array_fill(0, 12, 0);
while($row_chart = mysqli_fetch_assoc($rs_chart)) {
    $thangIndex = $row_chart['Thang'] - 1;
    $doanhThuTheoThang[$thangIndex] = $row_chart['DoanhThu'];
}

// Dữ liệu cho biểu đồ tròn
$sql_pie = "SELECT
    TinhTrang,
    COUNT(*) as SoLuong
    FROM hoadon
    GROUP BY TinhTrang";
$rs_pie = mysqli_query($conn, $sql_pie);
$labels = [];
$data = [];
$colors = [];
while($row_pie = mysqli_fetch_assoc($rs_pie)) {
    $labels[] = $row_pie['TinhTrang'];
    $data[] = $row_pie['SoLuong'];
    $colors[] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Các card thống kê -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <!-- Nội dung card doanh thu tháng -->
                </div>
            </div>
            <!-- Thêm các card khác tương tự -->
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Biểu đồ doanh thu năm <?php echo $nam; ?></h6>
                    </div>
                    <div class="card-body">
                        <canvas id="doanhThuChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tỉ lệ đơn hàng</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="donHangChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phần quản lý hệ thống -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Nội dung buttons quản lý -->
                </div>
            </div>
        </div>
    </div>

    <script>
    // Biểu đồ cột
    new Chart(document.getElementById('doanhThuChart'), {
        type: 'bar',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            datasets: [{
                label: 'Doanh thu (VND)',
                data: <?php echo json_encode($doanhThuTheoThang); ?>,
                backgroundColor: 'rgba(78, 115, 223, 0.5)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN', {style:'currency', currency:'VND'}).format(value);
                        }
                    }
                }
            }
        }
    });

    // Biểu đồ tròn
    new Chart(document.getElementById('donHangChart'), {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                data: <?php echo json_encode($data); ?>,
                backgroundColor: <?php echo json_encode($colors); ?>,
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20
                    }
                }
            }
        }
    });
    </script>
</body>
</html>