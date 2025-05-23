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
        header('location:?view=user&alert=');
        exit;
    } else {
        echo '<script>alert("Có lỗi xảy ra, vui lòng thử lại.");</script>';
    }
}

// Hiển thị alert khi có thông báo
if (isset($_GET['alert']) && $_GET['alert'] !== '') {
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>' . htmlspecialchars($_GET['alert']) . '</strong>
      <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
      </button>
    </div>';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- jQuery + Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --primary-color: #ffc107;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-color: #ffffff;
            --dark-color: #34495e;
        }

        body {
                        font-family: 'Roboto', sans-serif;
                        background-color: #f9f9f9;
                        color: #444;
                        line-height: 1.7;
                    }

        .breadcrumbs {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 15px 0;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .breadcrumbs a {
            color: white;
            transition: all 0.3s ease;
        }

        .breadcrumbs a:hover {
            color: var(--light-color);
            text-decoration: none;
        }

        .bread {
            margin: 0;
            font-size: 16px;
            font-weight: 500;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
        }

        .btn-link {
            color: var(--secondary-color);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            width: 100%;
            text-align: left;
        }

        .btn-link:hover {
            color: var(--primary-color);
            text-decoration: none;
        }

        .btn-link:focus {
            text-decoration: none;
        }

        .nav-pills .nav-link {
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-right: 10px;
            color: var(--secondary-color);
            border: 2px solid transparent;
        }

        .nav-pills .nav-link:hover {
            background-color: rgba(52, 152, 219, 0.1);
            border-color: var(--primary-color);
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-dark {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-dark:hover {
            background-color: var(--dark-color);
            border-color: var(--dark-color);
            box-shadow: 0 4px 10px rgba(44, 62, 80, 0.3);
        }

        .btn-info {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-info:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .badge {
            padding: 8px 12px;
            font-size: 85%;
            font-weight: 600;
            border-radius: 30px;
        }

        .badge-success {
            background-color: #2ecc71;
        }

        .badge-warning {
            background-color: #f39c12;
            color: white;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background-color: var(--light-color);
            border: none;
            padding: 12px 15px;
            font-weight: 600;
            color: var(--dark-color);
        }

        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            border-top: 1px solid #f1f1f1;
        }

        /* Animation effects */
        .tab-content {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Card hover effect for order items */
        .card-body {
            padding: 20px;
        }

        /* Custom input group styling */
        .input-group-append .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        /* Label styling */
        label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
        }

        /* Info form styling */
        #info_form {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        /* Empty order styling */
        .empty-order {
            text-align: center;
            padding: 40px 0;
            color: #7f8c8d;
        }

        .empty-order i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #bdc3c7;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0"><i class="fas fa-user-circle mr-2"></i>Tài khoản của bạn</h2>
            <p class="text-muted">Xin chào, <?php echo htmlspecialchars($kh['TenKH']); ?>!</p>
        </div>
    </div>

    <div class="bd-example bd-example-tabs">
        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a
                  class="nav-link"
                  id="pills-info-tab"
                  data-toggle="pill"
                  href="#pills-info"
                  role="tab"
                  aria-controls="pills-info"
                ><i class="fas fa-user-edit mr-2"></i>Thông Tin Cá Nhân</a>
            </li>
            <li class="nav-item">
                <a
                  class="nav-link active"
                  id="pills-orders-tab"
                  data-toggle="pill"
                  href="#pills-orders"
                  role="tab"
                  aria-controls="pills-orders"
                ><i class="fas fa-shopping-bag mr-2"></i>Đơn Hàng</a>
            </li>
            <li class="nav-item">
                <a
                  class="nav-link bg-info text-white"
                  href="?view=logout"
                  onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');"
                ><i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất</a>
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
                <form class="form-horizontal mb-4" method="post" id="info_form">
                    <div class="form-group">
                        <label disable><i class="fas fa-envelope mr-2"></i>Email</label>
                        <input
                          type="email"
                          name="email"
                          class="form-control"
                          value="<?php echo htmlspecialchars($kh['Email']); ?>"
                          readonly
                        >
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-user mr-2"></i>Họ và tên</label>
                        <input
                          type="text"
                          name="ten"
                          class="form-control"
                          value="<?php echo htmlspecialchars($kh['TenKH']); ?>"
                        >
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-phone mr-2"></i>Số điện thoại</label>
                        <input
                          type="text"
                          name="sdt"
                          class="form-control"
                          value="<?php echo htmlspecialchars($kh['SDT']); ?>"
                        >
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-map-marker-alt mr-2"></i>Địa chỉ</label>
                        <input
                          type="text"
                          name="dc"
                          class="form-control"
                          value="<?php echo htmlspecialchars($kh['DiaChi']); ?>"
                        >
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-lock mr-2"></i>Mật khẩu</label>
                        <div class="input-group">
                            <input
                              type="password"
                              id="password"
                              name="password"
                              class="form-control"
                              value="<?php echo htmlspecialchars($kh['MatKhau']); ?>"
                            >
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye" id="togglePassword"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="makh" value="<?php echo $kh['MaKH']; ?>">
                    <button type="submit" name="luu" class="btn btn-dark"><i class="fas fa-save mr-2"></i>Lưu thông tin</button>
                </form>
            </div>

            <!-- Tab Đơn Hàng -->
            <div
              class="tab-pane fade show active"
              id="pills-orders"
              role="tabpanel"
              aria-labelledby="pills-orders-tab"
            >
                <?php
                $bills = bill_user($kh['MaKH']);
                if (!$bills) {
                    echo '
                    <div class="empty-order">
                        <i class="fas fa-shopping-cart"></i>
                        <h4>Bạn chưa có đơn hàng nào</h4>
                        <p>Hãy tiếp tục mua sắm để tạo đơn hàng mới!</p>
                        <a href="?view" class="btn btn-info mt-3"><i class="fas fa-shopping-bag mr-2"></i>Tiếp tục mua sắm</a>
                    </div>';
                } else {
                    $first = true;
                ?>
                <div class="accordion" id="ordersAccordion">
                    <?php while ($order = mysqli_fetch_array($bills)):
                        $orderId   = $order['MaHD'];
                        $headId    = 'heading' . $orderId;
                        $collapseId= 'collapse' . $orderId;

                        // Xác định trạng thái đơn hàng và biểu tượng
                        $statusClass = $order['TinhTrang'] === 'Đã giao' ? 'success' : 'warning';
                        $statusIcon = $order['TinhTrang'] === 'Đã giao' ? 'check-circle' : 'clock';
                    ?>
                    <div class="card mb-3">
                        <div class="card-header" id="<?php echo $headId; ?>">
                            <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                <button
                                  class="btn btn-link"
                                  type="button"
                                  data-toggle="collapse"
                                  data-target="#<?php echo $collapseId; ?>"
                                  aria-expanded="<?php echo $first ? 'true' : 'false'; ?>"
                                  aria-controls="<?php echo $collapseId; ?>"
                                >
                                    <i class="fas fa-shopping-bag mr-2"></i>
                                    Đơn #<?php echo $orderId; ?> –
                                    <?php echo date('d/m/Y', strtotime($order['NgayDat'])); ?>
                                </button>
                                <span class="badge badge-<?php echo $statusClass; ?>">
                                    <i class="fas fa-<?php echo $statusIcon; ?> mr-1"></i>
                                    <?php echo htmlspecialchars($order['TinhTrang']); ?>
                                </span>
                            </h5>
                        </div>
                        <div
                          id="<?php echo $collapseId; ?>"
                          class="collapse <?php echo $first ? 'show' : ''; ?>"
                          aria-labelledby="<?php echo $headId; ?>"
                          data-parent="#ordersAccordion"
                        >
                            <div class="card-body">
                                <div class="order-summary mb-3 pb-3 border-bottom">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong><i class="fas fa-calendar-alt mr-2"></i>Ngày đặt:</strong> <?php echo date('d/m/Y H:i', strtotime($order['NgayDat'])); ?></p>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <p class="mb-1"><strong><i class="fas fa-money-bill-wave mr-2"></i>Tổng tiền:</strong> <span class="text-danger font-weight-bold"><?php echo number_format($order['TongTien']); ?> VNĐ</span></p>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mb-3"><i class="fas fa-list mr-2"></i>Chi tiết đơn hàng</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
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
                                            // Đoạn code để thay thế cho đoạn code hiện tại đang gặp lỗi
                                            $details = bill_detail($orderId);
                                            $i = 0;
                                            while ($item = mysqli_fetch_array($details)):
                                                $i++;
                                                $product_result = product($item['MaSP']);

                                                // Kiểm tra xem kết quả truy vấn có hợp lệ không
                                                if ($product_result !== false && mysqli_num_rows($product_result) > 0) {
                                                    $prod = mysqli_fetch_array($product_result);
                                                    $product_name = htmlspecialchars($prod['TenSP']);
                                                } else {
                                                    $product_name = "Sản phẩm không tồn tại";
                                                }

                                                $unit = isset($item['DonGia']) ? $item['DonGia'] : 0;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $product_name; ?></td>
                                                <td><?php echo htmlspecialchars($item['Size']); ?></td>
                                                <td><?php echo htmlspecialchars($item['MaMau']); ?></td>
                                                <td><?php echo $item['SoLuong']; ?></td>
                                                <td><?php echo number_format($unit); ?> VNĐ</td>
                                                <td class="font-weight-bold"><?php echo number_format($item['ThanhTien']); ?> VNĐ</td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
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

<script>
function togglePasswordVisibility() {
    var pw = document.getElementById('password');
    var icon = document.getElementById('togglePassword');

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
</script>
</body>
</html>