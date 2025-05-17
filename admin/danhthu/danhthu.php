<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = getdate();
    $namHienTai = $date['year'];
    $cacNam = array($namHienTai-2, $namHienTai-1, $namHienTai);

    // Xử lý tham số năm từ URL
    if(isset($_GET['nam'])){
        $namDuocChon = $_GET['nam'];
    } else {
        $namDuocChon = $namHienTai;
    }

    // Mảng lưu dữ liệu doanh thu cho biểu đồ
    $doanhThuTheoThang = array_fill(0, 12, 0);
    $tongDoanhThuNam = 0;

    // Lấy dữ liệu doanh thu cho từng tháng
    for($thang = 1; $thang <= 12; $thang++) {
        switch($thang) {
            case 1: case 3: case 5: case 7: case 8: case 10: case 12:
                $soNgay = 31;
                break;
            case 4: case 6: case 9: case 11:
                $soNgay = 30;
                break;
            case 2:
                // Xử lý năm nhuận
                $soNgay = (($namDuocChon % 4 == 0 && $namDuocChon % 100 != 0) || $namDuocChon % 400 == 0) ? 29 : 28;
                break;
        }

        $ngayBatDau = $namDuocChon.'-'.sprintf('%02d', $thang).'-01 00:00:00';
        $ngayKetThuc = $namDuocChon.'-'.sprintf('%02d', $thang).'-'.$soNgay.' 23:59:59';

        $sql = "SELECT SUM(TongTien) as DoanhThu FROM hoadon WHERE TinhTrang='hoàn thành' AND (NgayGiao BETWEEN '$ngayBatDau' AND '$ngayKetThuc')";
        $result = mysqli_query($conn, $sql);

        if($result && $row = mysqli_fetch_assoc($result)) {
            $doanhThuTheoThang[$thang-1] = (float)($row['DoanhThu'] ?? 0);
            $tongDoanhThuNam += $doanhThuTheoThang[$thang-1];
        }
    }

    // Xử lý tìm kiếm theo khoảng thời gian
    $doanhThuKhoangThoiGian = 0;
    $tuNgay = '';
    $denNgay = '';

    if(isset($_POST['xem2'])) {
        $tuNgay = $_POST['tu'];
        $denNgay = $_POST['den'];

        $sql = "SELECT SUM(TongTien) as DoanhThu FROM hoadon WHERE TinhTrang='hoàn thành' AND (NgayGiao BETWEEN '$tuNgay' AND '$denNgay')";
        $result = mysqli_query($conn, $sql);

        if($result && $row = mysqli_fetch_assoc($result)) {
            $doanhThuKhoangThoiGian = (float)($row['DoanhThu'] ?? 0);
        }
    }

    // Chuyển đổi dữ liệu doanh thu thành JSON để sử dụng trong biểu đồ
    $doanhThuJSON = json_encode($doanhThuTheoThang);

    // Tạo mảng tên tháng cho biểu đồ tròn
    $tenThang = [];
    for($thang = 1; $thang <= 12; $thang++) {
        $tenThang[] = 'Tháng ' . $thang;
    }
    $tenThangJSON = json_encode($tenThang);
?>

<div class="container-fluid">
    <!-- Tiêu đề trang -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-chart-line text-primary"></i> Quản lý doanh thu
        </h1>

    </div>

    <!-- Thẻ tổng quan -->
    <div class="row">
        <!-- Doanh thu năm -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Doanh thu năm <?php echo $namDuocChon; ?>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo number_format($tongDoanhThuNam) . ' đ'; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doanh thu tháng này -->
        <?php
        $thangHienTai = date('n') - 1; // Tháng hiện tại (0-11 cho JS)
        $doanhThuThangHienTai = $doanhThuTheoThang[$thangHienTai];
        $thangTruoc = ($thangHienTai - 1 < 0) ? 11 : $thangHienTai - 1;
        $doanhThuThangTruoc = $doanhThuTheoThang[$thangTruoc];

        // Tính phần trăm tăng/giảm
        $phanTram = 0;
        if($doanhThuThangTruoc > 0) {
            $phanTram = (($doanhThuThangHienTai - $doanhThuThangTruoc) / $doanhThuThangTruoc) * 100;
        }
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Doanh thu tháng <?php echo $thangHienTai + 1; ?>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo number_format($doanhThuThangHienTai) . ' đ'; ?>
                            </div>
                            <div class="mt-2 small">
                                <?php if($phanTram > 0): ?>
                                <span class="text-success"><i class="fas fa-arrow-up"></i> <?php echo number_format(abs($phanTram), 2); ?>%</span>
                                <?php elseif($phanTram < 0): ?>
                                <span class="text-danger"><i class="fas fa-arrow-down"></i> <?php echo number_format(abs($phanTram), 2); ?>%</span>
                                <?php else: ?>
                                <span class="text-muted"><i class="fas fa-equals"></i> 0%</span>
                                <?php endif; ?>
                                <span class="ml-1">so với tháng trước</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doanh thu trung bình tháng -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Doanh thu trung bình/tháng
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo number_format($tongDoanhThuNam / 12) . ' đ'; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tháng có doanh thu cao nhất -->
        <?php
        $thangCaoDiemIndex = array_search(max($doanhThuTheoThang), $doanhThuTheoThang);
        $thangCaoDiem = $thangCaoDiemIndex + 1;
        $doanhThuCaoDiem = $doanhThuTheoThang[$thangCaoDiemIndex];
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Tháng cao điểm
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Tháng <?php echo $thangCaoDiem; ?>
                            </div>
                            <div class="mt-2 small text-muted">
                                <?php echo number_format($doanhThuCaoDiem) . ' đ'; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bộ lọc -->


        <!-- Chọn khoảng thời gian -->

            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tìm kiếm theo khoảng thời gian</h6>
                </div>
                <div class="card-body">
                    <form action="?action=danhthu" method="POST">
                        <div class="form-row align-items-center">
                            <div class="col-md-4 mb-2 mb-md-0">
                                <label for="tuNgay">Từ ngày:</label>
                                <input type="date" id="tuNgay" class="form-control" name="tu" required value="<?php echo $tuNgay; ?>">
                            </div>
                            <div class="col-md-4 mb-2 mb-md-0">
                                <label for="denNgay">Đến ngày:</label>
                                <input type="date" id="denNgay" class="form-control" name="den" required value="<?php echo $denNgay; ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="d-md-block d-none">&nbsp;</label>
                                <button class="btn btn-primary btn-block" type="submit" name="xem2">
                                    <i class="fas fa-search"></i> Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ doanh thu -->


    <!-- Hiển thị kết quả tìm kiếm theo khoảng thời gian -->
    <?php if(isset($_POST['xem2'])): ?>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Kết quả doanh thu từ <?php echo date('d/m/Y', strtotime($tuNgay)); ?> đến <?php echo date('d/m/Y', strtotime($denNgay)); ?>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <h4 class="small font-weight-bold">Tổng doanh thu</h4>
                                <h2 class="text-primary"><?php echo number_format($doanhThuKhoangThoiGian); ?> đ</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="index.php?action=danhthu&view=ctdt&tu=<?php echo $tuNgay; ?>&den=<?php echo $denNgay; ?>"
                               class="btn btn-info btn-block">
                                <i class="fas fa-info-circle"></i> Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Bảng doanh thu chi tiết -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Doanh thu chi tiết theo tháng năm <?php echo $namDuocChon; ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tháng</th>
                                    <th>Doanh thu</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for($thang = 1; $thang <= 12; $thang++):
                                    $doanhThuThang = $doanhThuTheoThang[$thang-1];
                                ?>
                                <tr>
                                    <td>Tháng <?php echo $thang; ?></td>
                                    <td><?php echo number_format($doanhThuThang); ?> đ</td>
                                    <td>
                                        <a href="index.php?action=danhthu&view=ctdt&thang=<?php echo $thang; ?>&nam=<?php echo $namDuocChon; ?>"
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-search"></i> Chi tiết
                                        </a>
                                    </td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-light">
                                    <th>Tổng cộng</th>
                                    <th><?php echo number_format($tongDoanhThuNam); ?> đ</th>
                                    <th>-</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts cho biểu đồ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dữ liệu doanh thu
    var doanhThuData = <?php echo $doanhThuJSON; ?>;
    var tenThang = <?php echo $tenThangJSON; ?>;
    var namDuocChon = <?php echo $namDuocChon; ?>;

    // Tính doanh thu theo quý
    var quy1 = doanhThuData.slice(0, 3).reduce((a, b) => a + b, 0);
    var quy2 = doanhThuData.slice(3, 6).reduce((a, b) => a + b, 0);
    var quy3 = doanhThuData.slice(6, 9).reduce((a, b) => a + b, 0);
    var quy4 = doanhThuData.slice(9, 12).reduce((a, b) => a + b, 0);

    // Tạo mảng màu cho biểu đồ tròn
    var backgroundColors = [
        'rgba(78, 115, 223, 0.7)',
        'rgba(28, 200, 138, 0.7)',
        'rgba(54, 185, 204, 0.7)',
        'rgba(246, 194, 62, 0.7)',
        'rgba(231, 74, 59, 0.7)',
        'rgba(133, 135, 150, 0.7)',
        'rgba(105, 0, 132, 0.7)',
        'rgba(0, 137, 132, 0.7)',
        'rgba(254, 158, 40, 0.7)',
        'rgba(90, 173, 246, 0.7)',
        'rgba(245, 105, 84, 0.7)',
        'rgba(153, 102, 255, 0.7)'
    ];

    var hoverColors = [
        'rgba(78, 115, 223, 1)',
        'rgba(28, 200, 138, 1)',
        'rgba(54, 185, 204, 1)',
        'rgba(246, 194, 62, 1)',
        'rgba(231, 74, 59, 1)',
        'rgba(133, 135, 150, 1)',
        'rgba(105, 0, 132, 1)',
        'rgba(0, 137, 132, 1)',
        'rgba(254, 158, 40, 1)',
        'rgba(90, 173, 246, 1)',
        'rgba(245, 105, 84, 1)',
        'rgba(153, 102, 255, 1)'
    ];

    // Cấu hình biểu đồ tròn doanh thu theo tháng
    var ctx = document.getElementById('doanhThuChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: tenThang,
            datasets: [{
                data: doanhThuData,
                backgroundColor: backgroundColors,
                hoverBackgroundColor: hoverColors,
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            legend: {
                display: true,
                position: 'right'
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.labels[tooltipItem.index] || '';
                        var value = chart.datasets[0].data[tooltipItem.index];
                        var total = chart.datasets[0].data.reduce((a, b) => a + b, 0);
                        var percentage = Math.round((value / total) * 100);
                        return datasetLabel + ': ' + formatMoney(value) + ' đ (' + percentage + '%)';
                    }
                }
            }
        }
    });

    // Biểu đồ tròn phân bố doanh thu theo quý
    var ctxPie = document.getElementById('doanhThuPieChart').getContext('2d');
    var myPieChart = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ["Quý 1", "Quý 2", "Quý 3", "Quý 4"],
            datasets: [{
                data: [quy1, quy2, quy3, quy4],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var tong = data.datasets[0].data.reduce((a, b) => a + b, 0);
                        var giaTriQuy = data.datasets[0].data[tooltipItem.index];
                        var phanTram = ((giaTriQuy / tong) * 100).toFixed(1);
                        return data.labels[tooltipItem.index] + ': ' + formatMoney(giaTriQuy) + ' đ (' + phanTram + '%)';
                    }
                }
            },
            legend: {
                display: false
            },
            cutoutPercentage: 70,
        },
    });

    // Tải xuống biểu đồ
    document.getElementById('btnDownloadChart').addEventListener('click', function(e) {
        e.preventDefault();
        // Tạo link tải xuống
        var link = document.createElement('a');
        link.href = myChart.toBase64Image();
        link.download = 'doanh-thu-' + namDuocChon + '.png';
        link.click();
    });

    // Hàm định dạng tiền tệ
    function formatMoney(number) {
        return new Intl.NumberFormat('vi-VN').format(number);
    }

    // Xuất báo cáo PDF
    document.getElementById('btnExportPDF').addEventListener('click', function() {
        window.print();
    });

    // Xuất báo cáo Excel
    document.getElementById('btnExportExcel').addEventListener('click', function() {
        window.location.href = 'danhthu/export_excel.php?nam=' + namDuocChon +
            (document.getElementById('tuNgay').value ? '&tu=' + document.getElementById('tuNgay').value : '') +
            (document.getElementById('denNgay').value ? '&den=' + document.getElementById('denNgay').value : '');
    });
});