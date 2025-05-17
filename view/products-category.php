<?php
// -----------------------------------------------------
// File: product-category.php (cập nhật)
// Xử lý tìm kiếm và lọc cho trang category
$key = isset($_GET['key']) ? trim($_GET['key']) : '';
$sortFlg = isset($_GET['sort']) && $_GET['sort'] === 'asc';

if ($key !== '') {
    // Tìm kiếm chung trong category (toàn bộ sản phẩm hoặc có thể dùng thêm điều kiện MaLoaiSP)
    $products = product_search($key);
} elseif ($sortFlg) {
    // Lọc giá trong category (dựa trên cột MaLoaiSP để phân theo category)
    global $conn;
    $catId = intval($_GET['id']);
    $sql = "SELECT * FROM sanpham WHERE MaLoaiSP = {$catId} ORDER BY DonGia ASC";
    $products = mysqli_query($conn, $sql);
} else {
    // theo switch cũ
    switch ($_GET['view']) {
        case 'products-category':
            $products = product_category($_GET['id']);
            break;
        case 'products-search':
            $products = product_search($_POST['key']);
            break;
        default:
            $products = product_category($_GET['id']);
            break;
    }
}
?>


<!-- Danh sách sản phẩm -->
<div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row product-grid">
                    <?php while ($row = mysqli_fetch_array($products)) {
                        $price_sale = price_sale($row['MaSP'], $row['DonGia']);
                        $hasDiscount = $price_sale < $row['DonGia'];
                    ?>
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div class="product-card">
                                <a href="?view=product-detail&id=<?php echo $row['MaSP']; ?>" class="product-link">
                                    <?php if ($hasDiscount) { ?>
                                        <div class="discount-badge">
                                            <span>-<?php echo number_format(($row['DonGia'] - $price_sale) / $row['DonGia'] * 100, 0); ?>%</span>
                                        </div>
                                    <?php } ?>

                                    <div class="product-image">
                                        <img src="webroot/image/sanpham/<?php echo $row['AnhNen']; ?>" alt="<?php echo $row['TenSP']; ?>" class="img-fluid">
                                    </div>

                                    <div class="product-info">
                                        <h5 class="product-title"><?php echo $row['TenSP']; ?></h5>

                                        <div class="product-price">
                                            <span class="current-price"><?php echo number_format($price_sale, 0) . 'đ'; ?></span>
                                            <?php if ($hasDiscount) { ?>
                                                <span class="original-price"><?php echo number_format($row['DonGia']) . 'đ'; ?></span>
                                            <?php } ?>
                                        </div>

                                        <div class="product-action">
                                            <span class="btn-view">Xem chi tiết</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Phần thương hiệu -->
<div class="brands-section py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-2">SPONSORSHIP</h2>
        <p class="section-subtitle text-center mb-4">Ngắm nhìn những bức ảnh từ khách hàng của chúng tôi</p>

        <div class="row justify-content-center brand-logos">
            <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="col-6 col-sm-4 col-md-2 p-2">
                    <div class="brand-item">
                        <img src="webroot/image/brand/mau<?php echo $i; ?>.jpg" class="img-fluid" alt="mau <?php echo $i; ?>">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<style>
    :root {
                --primary-color: #ffc107;
                --secondary-color: #212529;
                --light-color: #FFFFFF;
                --dark-color: #343a40;
                --accent-color: #fd7e14;
            }
/* Styling cho form tìm kiếm */
.search-filter-form {
    margin-bottom: 30px;
}
body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            color: #444;
            line-height: 1.7;
        }
.search-input {
    border-radius: 4px 0 0 4px;
    padding: 10px 15px;
    font-size: 14px;
    border: 1px solid #ddd;
}

.search-btn {
    border-radius: 0 4px 4px 0;
    padding: 10px 20px;
    transition: all 0.3s;
}

.filter-options {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.filter-options .btn {
    font-size: 13px;
    padding: 5px 10px;
}

.filter-options .active {
    background-color: #007bff;
    color: white;
}

/* Styling cho breadcrumbs */
.breadcrumbs {
    background-color: #f8f9fa;
    padding: 10px 0;
    margin-bottom: 30px;
}

.breadcrumb {
    margin-bottom: 0;
    padding: 0;
}

.breadcrumb-item a {
    color: #007bff;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: #6c757d;
}

/* Styling cho sản phẩm */
.product-grid {
    margin: 0 -10px;
}

.product-card {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
    background: white;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.product-link {
    display: block;
    text-decoration: none;
    color: #333;
    height: 100%;
}

.product-image {
    position: relative;
    padding-top: 100%;
    overflow: hidden;
}

.product-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.discount-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #ff3860;
    color: white;
    padding: 5px 10px;
    border-radius: 25px;
    font-size: 12px;
    font-weight: bold;
    z-index: 1;
}

.product-info {
    padding: 15px;
}

.product-title {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 10px;
    height: 40px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.product-price {
    margin-bottom: 15px;
}

.current-price {
    font-size: 16px;
    font-weight: 700;
    color: #e83e8c;
}

.original-price {
    font-size: 13px;
    color: #999;
    text-decoration: line-through;
    margin-left: 5px;
}

.product-action {
    text-align: center;
    margin-top: 10px;
}

.btn-view {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 8px 15px;
    border-radius: 4px;
    font-size: 13px;
    transition: all 0.3s;
}

.product-card:hover .btn-view {
    background-color: #0069d9;
}

/* Styling cho phần sponsors */
.brands-section {
    padding: 50px 0;
    margin-top: 30px;
}

.section-title {
    font-size: 24px;
    font-weight: 700;
    color: #333;
}

.section-subtitle {
    font-size: 14px;
    color: #6c757d;
}

.brand-logos {
    margin-top: 30px;
}

.brand-item {
    padding: 10px;
    background: white;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    transition: all 0.3s;
}

.brand-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Responsive adjustments */
@media (max-width: 767px) {
    .product-title {
        font-size: 13px;
        height: 36px;
    }

    .current-price {
        font-size: 14px;
    }

    .original-price {
        font-size: 12px;
    }
}
</style>