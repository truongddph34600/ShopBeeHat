<?php
include_once('../model/database.php');

    // lấy danh sách sản phẩm theo phân trang.
    if(isset($_GET['trang'])){
        $trang = $_GET['trang'];
    }
    else{
        $trang = 1;
    }
    $from = ($trang-1) * 20;
    $sql = "SELECT * FROM `sanpham` LIMIT $from,20";
    $rs = mysqli_query($conn, $sql);

    // Lấy tổng số sản phẩm để tính phân trang
    $ds_spn1b = "SELECT MaSP FROM `sanpham`";
    $query_dssp2 = mysqli_query($conn, $ds_spn1b);
    $sosp = mysqli_num_rows($query_dssp2);
    $sotrang = ceil($sosp/20);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
            --info-color: #36b9cc;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fc;
        }

        .dashboard-header {
            background: linear-gradient(to right, var(--primary-color), #224abe);
            color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dashboard-title {
            display: flex;
            align-items: center;
            margin: 0;
        }

        .icon-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            margin-right: 15px;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .table-container {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            font-weight: 500;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .product-image {
            border-radius: 6px;
            object-fit: cover;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .product-image:hover {
            transform: scale(1.15);
        }

        .btn-action {
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .btn-edit {
            background-color: var(--info-color);
            color: white;
        }

        .btn-edit:hover {
            background-color: #2a93a8;
            color: white;
        }

        .btn-delete {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-delete:hover {
            background-color: #c23e30;
            color: white;
        }

        .search-container {
            position: relative;
            margin-bottom: 20px;
        }

        .search-input {
            padding-left: 40px;
            border-radius: 25px;
            border: 1px solid #e3e6f0;
            height: 45px;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 12px;
            color: #b7b9cc;
        }

        .add-product-btn {
            background: linear-gradient(to right, var(--secondary-color), #169f70);
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 500;
            box-shadow: 0 4px 6px rgba(28, 200, 138, 0.2);
            transition: all 0.2s;
        }

        .add-product-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(28, 200, 138, 0.3);
        }

        .pagination {
            margin-top: 20px;
        }

        .page-item .page-link {
            color: var(--primary-color);
            border: 1px solid #e3e6f0;
            margin: 0 3px;
            border-radius: 5px;
            font-weight: 500;
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .tooltip-inner {
            max-width: 300px;
        }

        .badge-count {
            background-color: var(--info-color);
            color: white;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 10px;
        }

        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }
    </style>
</head>
<body>

<div class="container-fluid py-4">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="dashboard-title">
            <div class="icon-circle">
                <i class="fas fa-box-open"></i>
            </div>
            <h4 class="m-0">Quản lý sản phẩm</h4>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card">
        <div class="card-body">
            <!-- Include PHP file -->
            <?php include_once('sanpham/main.php');?>

            <!-- Action Bar -->


            <!-- Product Stats -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary h-100 py-2" style="border-left: 4px solid var(--primary-color);">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Tổng sản phẩm</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sosp; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success h-100 py-2" style="border-left: 4px solid var(--secondary-color);">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Có sẵn</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                            // Demo data - bạn có thể thay thế bằng truy vấn thực tế
                                            echo floor($sosp * 0.8);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info h-100 py-2" style="border-left: 4px solid var(--info-color);">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Danh mục
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                            // Demo data - bạn có thể thay thế bằng truy vấn thực tế
                                            echo 8;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning h-100 py-2" style="border-left: 4px solid var(--warning-color);">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Sắp hết hàng</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                            // Demo data - bạn có thể thay thế bằng truy vấn thực tế
                                            echo floor($sosp * 0.1);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="table-container">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th><i class="fas fa-image me-2"></i>Ảnh</th>
                            <th><i class="fas fa-barcode me-2"></i>Mã SP</th>
                            <th><i class="fas fa-tag me-2"></i>Tên sản phẩm</th>
                            <th><i class="fas fa-layer-group me-2"></i>Mã loại</th>
                            <th><i class="fas fa-sitemap me-2"></i>Mã DM</th>
                            <th><i class="fas fa-cubes me-2"></i>Số lượng</th>
                            <th><i class="fas fa-align-left me-2"></i>Mô tả</th>
                            <th><i class="fas fa-money-bill-wave me-2"></i>Đơn giá</th>
                            <th><i class="fas fa-cogs me-2"></i>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($rs)) { ?>
                        <tr>
                            <td class="text-center">
                                <img src="../webroot/image/sanpham/<?php echo $row['AnhNen']; ?>"
                                     class="product-image" width="60" height="60" alt="<?php echo $row['TenSP']; ?>">
                            </td>
                            <td class="align-middle"><?php echo $row['MaSP']; ?></td>
                            <td class="align-middle truncate"><?php echo $row['TenSP']; ?></td>
                            <td class="align-middle"><?php echo $row['MaDM']; ?></td>
                            <td class="align-middle"><?php echo $row['MaNCC']; ?></td>
                            <td class="align-middle">
                                <span class="badge <?php echo ($row['SoLuong'] > 10) ? 'bg-success' : 'bg-warning'; ?> px-2">
                                    <?php echo $row['SoLuong']; ?>
                                </span>
                            </td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="<?php echo $row['MoTa']; ?>">
                                    <i class="fas fa-eye"></i> Xem
                                </button>
                            </td>
                            <td class="align-middle fw-bold"><?php echo number_format($row['DonGia']).'đ'; ?></td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center">
                                    <a href="index.php?action=sanpham&view=suasp&masp=<?php echo $row['MaSP']; ?>"
                                       class="btn btn-sm btn-edit me-2">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <a href="sanpham/main.php?view=xoasp&masp=<?php echo $row['MaSP']; ?>"
                                       class="btn btn-sm btn-delete"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Empty State (shown when no products available) -->
            <?php if(mysqli_num_rows($rs) == 0): ?>
            <div class="text-center py-5">
                <img src="/api/placeholder/200/200" alt="No products" class="mb-3" width="120">
                <h5>Không có sản phẩm nào</h5>
                <p class="text-muted">Hãy thêm sản phẩm mới để bắt đầu</p>
                <button class="btn add-product-btn mt-2">
                    <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
                </button>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Pagination -->
    <?php if($sotrang > 1): ?>
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if($trang > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?action=sanpham&trang=<?php echo $trang-1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php
                // Hiển thị tối đa 5 trang
                $start_page = max(1, $trang - 2);
                $end_page = min($sotrang, $start_page + 4);

                if($start_page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?action=sanpham&trang=1">1</a>
                </li>
                <?php if($start_page > 2): ?>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                <?php endif; ?>
                <?php endif; ?>

                <?php for($x = $start_page; $x <= $end_page; $x++): ?>
                <li class="page-item <?php echo ($x == $trang) ? 'active' : ''; ?>">
                    <a class="page-link" href="index.php?action=sanpham&trang=<?php echo $x; ?>"><?php echo $x; ?></a>
                </li>
                <?php endfor; ?>

                <?php if($end_page < $sotrang): ?>
                <?php if($end_page < $sotrang - 1): ?>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                <?php endif; ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?action=sanpham&trang=<?php echo $sotrang; ?>"><?php echo $sotrang; ?></a>
                </li>
                <?php endif; ?>

                <?php if($trang < $sotrang): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?action=sanpham&trang=<?php echo $trang+1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <?php endif; ?>

    <div class="mt-4 text-center text-muted">
        <small>Hiển thị <?php echo mysqli_num_rows($rs); ?> sản phẩm trên trang <?php echo $trang; ?> (Tổng số: <?php echo $sosp; ?> sản phẩm)</small>
    </div>
</div>

<!-- Bootstrap JS & Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<script>
    // Enable tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Search functionality
    document.querySelector('.search-input').addEventListener('keyup', function() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.querySelector('.search-input');
        filter = input.value.toUpperCase();
        table = document.querySelector('table');
        tr = table.getElementsByTagName('tr');

        for (i = 1; i < tr.length; i++) {
            // Tìm kiếm trong cột mã và tên
            tdCode = tr[i].getElementsByTagName('td')[1];
            tdName = tr[i].getElementsByTagName('td')[2];

            if (tdCode || tdName) {
                txtValueCode = tdCode.textContent || tdCode.innerText;
                txtValueName = tdName.textContent || tdName.innerText;

                if (txtValueCode.toUpperCase().indexOf(filter) > -1 ||
                    txtValueName.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    });
</script>
</body>
</html>