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
    <title>Thông tin khách hàng</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
</head>
<body>

<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread">
                    <span><a href="?view">Trang Chủ</a></span> /
                    <span>Thông tin khách hàng</span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="bd-example bd-example-tabs">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a
                  class="nav-link"
                  id="pills-info-tab"
                  data-toggle="pill"
                  href="#pills-info"
                  role="tab"
                  aria-controls="pills-info"
                >Đổi Thông Tin và Mật Khẩu</a>
            </li>
            <li class="nav-item">
                <a
                  class="nav-link active"
                  id="pills-orders-tab"
                  data-toggle="pill"
                  href="#pills-orders"
                  role="tab"
                  aria-controls="pills-orders"
                >Đơn Hàng</a>
            </li>
            <li class="nav-item">
                <a
                  class="nav-link bg-info text-white"
                  href="?view=logout"
                  onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');"
                >Đăng xuất</a>
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
                        <label>Email</label>
                        <input
                          type="email"
                          name="email"
                          class="form-control"
                          value="<?php echo htmlspecialchars($kh['Email']); ?>"
                          readonly
                        >
                    </div>
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input
                          type="text"
                          name="ten"
                          class="form-control"
                          value="<?php echo htmlspecialchars($kh['TenKH']); ?>"
                          data-initial-value="<?php echo htmlspecialchars($kh['TenKH']); ?>"
                        >
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input
                          type="text"
                          name="sdt"
                          class="form-control"
                          value="<?php echo htmlspecialchars($kh['SDT']); ?>"
                          data-initial-value="<?php echo htmlspecialchars($kh['SDT']); ?>"
                        >
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input
                          type="text"
                          name="dc"
                          class="form-control"
                          value="<?php echo htmlspecialchars($kh['DiaChi']); ?>"
                          data-initial-value="<?php echo htmlspecialchars($kh['DiaChi']); ?>"
                        >
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <div class="input-group">
                            <input
                              type="password"
                              id="password"
                              name="password"
                              class="form-control"
                              value="<?php echo htmlspecialchars($kh['MatKhau']); ?>"
                              data-initial-value="<?php echo htmlspecialchars($kh['MatKhau']); ?>"
                            >
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility()">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="makh" value="<?php echo $kh['MaKH']; ?>">
                    <button type="submit" name="luu" class="btn btn-dark">Lưu</button>
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
                    echo '<p>Bạn chưa có đơn hàng nào.</p>';
                } else {
                    $first = true;
                ?>
                <div class="accordion" id="ordersAccordion">
                    <?php while ($order = mysqli_fetch_array($bills)):
                        $orderId   = $order['MaHD'];
                        $headId    = 'heading' . $orderId;
                        $collapseId= 'collapse' . $orderId;
                    ?>
                    <div class="card mb-2">
                        <div class="card-header" id="<?php echo $headId; ?>">
                            <h5 class="mb-0">
                                <button
                                  class="btn btn-link"
                                  type="button"
                                  data-toggle="collapse"
                                  data-target="#<?php echo $collapseId; ?>"
                                  aria-expanded="<?php echo $first ? 'true' : 'false'; ?>"
                                  aria-controls="<?php echo $collapseId; ?>"
                                >
                                    Đơn #<?php echo $orderId; ?> –
                                    <?php echo date('d/m/Y', strtotime($order['NgayDat'])); ?> –
                                    Tổng: <?php echo number_format($order['TongTien']); ?> VNĐ
                                </button>
                            </h5>
                        </div>
                        <div
                          id="<?php echo $collapseId; ?>"
                          class="collapse <?php echo $first ? 'show' : ''; ?>"
                          aria-labelledby="<?php echo $headId; ?>"
                          data-parent="#ordersAccordion"
                        >
                            <div class="card-body">
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
                                        $details = bill_detail($orderId);
                                        $i = 0;
                                        while ($item = mysqli_fetch_array($details)):
                                            $i++;
                                            $prod = mysqli_fetch_array(product($item['MaSP']));
                                            $unit = isset($item['DonGia']) ? $item['DonGia'] : 0;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($prod['TenSP']); ?></td>
                                            <td><?php echo htmlspecialchars($item['Size']); ?></td>
                                            <td><?php echo htmlspecialchars($item['MaMau']); ?></td>
                                            <td><?php echo $item['SoLuong']; ?></td>
                                            <td><?php echo number_format($unit); ?></td>
                                            <td><?php echo number_format($item['ThanhTien']); ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                                <span class="badge badge-<?php echo $order['TinhTrang'] === 'Đã giao' ? 'success' : 'warning'; ?>">
                                    <?php echo htmlspecialchars($order['TinhTrang']); ?>
                                </span>
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

<!-- Bootstrap & FontAwesome JS, jQuery -->
<script src="path/to/jquery.min.js"></script>
<script src="path/to/bootstrap.bundle.min.js"></script>
<script>
function togglePasswordVisibility() {
    var pw = document.getElementById('password');
    if (pw.type === 'password') {
        pw.type = 'text';
    } else {
        pw.type = 'password';
    }
}

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
        alert('Bạn chưa có thay đổi gì');
        e.preventDefault();
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