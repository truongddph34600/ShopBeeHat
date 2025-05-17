<?php
// user.php

// Khởi động session nếu chưa có
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Kiểm tra đăng nhập
if (!isset($_SESSION['laclac_khachang'])) {
    header('location:?view=login');
    exit;
} else {
    $kh = $_SESSION['laclac_khachang'];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3a6ea5;
            --secondary-color: #f8f9fa;
            --accent-color: #ff6b6b;
            --text-color: #333;
            --light-text: #6c757d;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            color: var(--text-color);
            line-height: 1.6;
        }

        .breadcrumbs {
            background-color: var(--secondary-color);
            padding: 1rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid #e9ecef;
        }

        .bread {
            margin: 0;
            font-size: 0.9rem;
        }

        .bread a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .bread a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        .user-dashboard {
            background-color: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .nav-pills .nav-link {
            color: var(--text-color);
            font-weight: 500;
            border-radius: var(--border-radius);
            padding: 0.75rem 1.5rem;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link:hover {
            background-color: rgba(58, 110, 165, 0.1);
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .nav-pills .nav-link.logout-btn {
            background-color: var(--accent-color);
            color: white;
        }

        .nav-pills .nav-link.logout-btn:hover {
            background-color: #ff5252;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(58, 110, 165, 0.25);
        }

        .btn {
            border-radius: var(--border-radius);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #2c5282;
            border-color: #2c5282;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: var(--secondary-color);
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e9ecef;
        }

        .btn-link {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
            display: block;
            width: 100%;
            text-align: left;
            padding: 0;
        }

        .btn-link:hover, .btn-link:focus {
            color: #2c5282;
            text-decoration: none;
        }

        .table {
            background-color: white;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table thead th {
            background-color: var(--secondary-color);
            border-bottom: 2px solid #e9ecef;
            color: var(--text-color);
            font-weight: 500;
        }

        .badge {
            padding: 0.5rem 0.75rem;
            font-weight: 500;
            border-radius: 4px;
        }

        .badge-success {
            background-color: #48bb78;
        }

        .badge-warning {
            background-color: #f6ad55;
            color: #fff;
        }

        .alert {
            border-radius: var(--border-radius);
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }

        .password-toggle {
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        /* Animation for alerts */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert {
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .nav-pills .nav-link {
                padding: 0.5rem 1rem;
                margin-bottom: 0.5rem;
                width: 100%;
            }

            .user-dashboard {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="user-dashboard">
        <h3 class="mb-4"><i class="fas fa-user-circle me-2"></i>Tài khoản của <?php echo htmlspecialchars($kh['TenKH']); ?></h3>

        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link"
                    id="pills-info-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-info"
                    type="button"
                    role="tab"
                    aria-controls="pills-info"
                    aria-selected="false"
                ><i class="fas fa-user-edit me-2"></i>Thông Tin & Mật Khẩu</button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link active"
                    id="pills-orders-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-orders"
                    type="button"
                    role="tab"
                    aria-controls="pills-orders"
                    aria-selected="true"
                ><i class="fas fa-shopping-bag me-2"></i>Đơn Hàng</button>
            </li>
            <li class="nav-item" role="presentation">
                <a
                    class="nav-link logout-btn"
                    href="?view=logout"
                    onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');"
                ><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <!-- Tab Thông Tin -->
            <div
                class="tab-pane fade"
                id="pills-info"
                role="tabpanel"
                aria-labelledby="pills-info-tab"
            >
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Thông tin cá nhân</h5>
                        <form class="form-horizontal mb-4" method="post" id="info_form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            value="<?php echo htmlspecialchars($kh['Email']); ?>"
                                            readonly
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label"><i class="fas fa-user me-2"></i>Họ và tên</label>
                                        <input
                                            type="text"
                                            name="ten"
                                            class="form-control"
                                            value="<?php echo htmlspecialchars($kh['TenKH']); ?>"
                                            data-initial-value="<?php echo htmlspecialchars($kh['TenKH']); ?>"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label"><i class="fas fa-phone me-2"></i>Số điện thoại</label>
                                        <input
                                            type="text"
                                            name="sdt"
                                            class="form-control"
                                            value="<?php echo htmlspecialchars($kh['SDT']); ?>"
                                            data-initial-value="<?php echo htmlspecialchars($kh['SDT']); ?>"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label"><i class="fas fa-home me-2"></i>Địa chỉ</label>
                                        <input
                                            type="text"
                                            name="dc"
                                            class="form-control"
                                            value="<?php echo htmlspecialchars($kh['DiaChi']); ?>"
                                            data-initial-value="<?php echo htmlspecialchars($kh['DiaChi']); ?>"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label"><i class="fas fa-lock me-2"></i>Mật khẩu</label>
                                <div class="input-group">
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control"
                                        value="<?php echo htmlspecialchars($kh['MatKhau']); ?>"
                                        data-initial-value="<?php echo htmlspecialchars($kh['MatKhau']); ?>"
                                    >
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility()">
                                        <i id="password-toggle-icon" class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="makh" value="<?php echo $kh['MaKH']; ?>">
                            <button type="submit" name="luu" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Lưu thay đổi
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab Đơn Hàng -->
            <div
                class="tab-pane fade show active"
                id="pills-orders"
                role="tabpanel"
                aria-labelledby="pills-orders-tab"
            >
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4"><i class="fas fa-history me-2"></i>Lịch sử đơn hàng</h5>

                        <?php
                        $bills = bill_user($kh['MaKH']);
                        if (!$bills) {
                            echo '<div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>Bạn chưa có đơn hàng nào.
                            </div>';
                        } else {
                            $first = true;
                        ?>
                        <div class="accordion" id="ordersAccordion">
                            <?php while ($order = mysqli_fetch_array($bills)):
                                $orderId   = $order['MaHD'];
                                $headId    = 'heading' . $orderId;
                                $collapseId= 'collapse' . $orderId;

                                // Xác định trạng thái đơn hàng
                                $statusClass = '';
                                $statusIcon = '';

                                if ($order['TinhTrang'] === 'Đã giao') {
                                    $statusClass = 'success';
                                    $statusIcon = 'fa-check-circle';
                                } else {
                                    $statusClass = 'warning';
                                    $statusIcon = 'fa-clock';
                                }
                            ?>
                            <div class="card mb-3 border-<?php echo $statusClass; ?> border-top-0 border-end-0 border-bottom-0 border-3">
                                <div class="card-header" id="<?php echo $headId; ?>">
                                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                        <button
                                            class="btn btn-link collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#<?php echo $collapseId; ?>"
                                            aria-expanded="<?php echo $first ? 'true' : 'false'; ?>"
                                            aria-controls="<?php echo $collapseId; ?>"
                                        >
                                            <i class="fas fa-shopping-cart me-2"></i>
                                            Đơn #<?php echo $orderId; ?>
                                            <span class="text-secondary ms-2">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                <?php echo date('d/m/Y', strtotime($order['NgayDat'])); ?>
                                            </span>
                                        </button>
                                        <div>
                                            <span class="badge bg-<?php echo $statusClass; ?>">
                                                <i class="fas <?php echo $statusIcon; ?> me-1"></i>
                                                <?php echo htmlspecialchars($order['TinhTrang']); ?>
                                            </span>
                                        </div>
                                    </h5>
                                </div>
                                <div
                                    id="<?php echo $collapseId; ?>"
                                    class="collapse <?php echo $first ? 'show' : ''; ?>"
                                    aria-labelledby="<?php echo $headId; ?>"
                                    data-bs-parent="#ordersAccordion"
                                >
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Sản phẩm</th>
                                                        <th>Size</th>
                                                        <th>Màu</th>
                                                        <th>Số lượng</th>
                                                        <th>Đơn giá</th>
                                                        <th>Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $details = bill_detail($orderId);
                                                    $i = 0;
                                                    while ($item = mysqli_fetch_array($details)):
                                                        $i++;
                                                        $prod = mysqli_fetch_array(product($item['MaSP']));
                                                        $unit = isset($item['DonGia']) ? $item['DonGia'] : 0;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td>
                                                            <strong><?php echo htmlspecialchars($prod['TenSP']); ?></strong>
                                                        </td>
                                                        <td><?php echo htmlspecialchars($item['Size']); ?></td>
                                                        <td>
                                                            <span class="badge bg-light text-dark">
                                                                <?php echo htmlspecialchars($item['MaMau']); ?>
                                                            </span>
                                                        </td>
                                                        <td><?php echo $item['SoLuong']; ?></td>
                                                        <td><?php echo number_format($unit); ?> VNĐ</td>
                                                        <td><strong><?php echo number_format($item['ThanhTien']); ?> VNĐ</strong></td>
                                                    </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6" class="text-end"><strong>Tổng cộng:</strong></td>
                                                        <td><strong><?php echo number_format($order['TongTien']); ?> VNĐ</strong></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $first = false;
                            endwhile; ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert hiển thị thông báo -->
<?php
// Hiển thị alert khi có thông báo
if (isset($_GET['alert']) && $_GET['alert'] !== '') {
    echo '
    <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert" style="max-width: 400px; z-index:1050;">
      <i class="fas fa-check-circle me-2"></i><strong>' . htmlspecialchars($_GET['alert']) . '</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>

<!-- Bootstrap & FontAwesome JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePasswordVisibility() {
    var pw = document.getElementById('password');
    var icon = document.getElementById('password-toggle-icon');

    if (pw.type === 'password') {
        pw.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        pw.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Kích hoạt tab từ URL nếu có
document.addEventListener('DOMContentLoaded', function() {
    // Lấy URL params
    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');

    // Nếu có tham số tab trong URL
    if (tab === 'info') {
        document.getElementById('pills-info-tab').click();
    }

    // Thêm hiệu ứng cho các phần tử
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 8px 15px rgba(0,0,0,0.1)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 2px 4px rgba(0,0,0,0.05)';
        });
    });
});

// Validate form
document.getElementById('info_form').addEventListener('submit', function(e) {
    let hasChange = false;

    // Kiểm tra các trường có thể thay đổi
    const fieldsToCheck = ['ten', 'sdt', 'dc', 'password'];
    const inputs = this.elements;

    fieldsToCheck.forEach(fieldName => {
        const input = inputs[fieldName];
        const initialValue = input.getAttribute('data-initial-value');
        if (input.value !== initialValue) {
            hasChange = true;
        }
    });

    if (!hasChange) {
        e.preventDefault();

        // Hiển thị thông báo với animation
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-warning alert-dismissible fade show position-fixed bottom-0 end-0 m-3';
        alertDiv.role = 'alert';
        alertDiv.style = 'max-width: 400px; z-index:1050; animation: fadeIn 0.5s ease-in-out;';
        alertDiv.innerHTML = `
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Bạn chưa có thay đổi gì</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        document.body.appendChild(alertDiv);

        // Tự động xóa sau 3 giây
        setTimeout(() => {
            alertDiv.remove();
        }, 3000);

        return false;
    }
    else {
        const confirmChange = confirm('Bạn có chắc chắn thay đổi không?');
        if (!confirmChange) {
            e.preventDefault();
            // Khôi phục giá trị ban đầu
            fieldsToCheck.forEach(fieldName => {
                const input = inputs[fieldName];
                input.value = input.getAttribute('data-initial-value');
            });
            return false;
        }
    }
});

// Tự động ẩn thông báo sau 5 giây
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    });
}, 5000);
</script>

</body>
</html>

<?php
// Xử lý lưu thông tin khi submit form
if (isset($_POST['luu'])) {
    $id      = $_POST['makh'];
    $ten     = $_POST['ten'];
    $sdt     = $_POST['sdt'];
    $matkhau = $_POST['password'];
    $dc      = $_POST['dc'];

    if (update_user($id, $ten, $sdt, $dc, $matkhau)) {
        $_SESSION['laclac_khachang'] = selectKH($id);
        header('location:?view=user&alert=Thông tin của bạn đã được cập nhật thành công');
        exit;
    } else {
        echo '<script>
            const alertDiv = document.createElement("div");
            alertDiv.className = "alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 m-3";
            alertDiv.role = "alert";
            alertDiv.style = "max-width: 400px; z-index:1050; animation: fadeIn 0.5s ease-in-out;";
            alertDiv.innerHTML = `
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Có lỗi xảy ra, vui lòng thử lại.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        </script>';
    }
}
?>