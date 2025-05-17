<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sản phẩm</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #ffc107;
      --primary-dark: #e0a800;
      --primary-light: #fff3cd;
      --text-dark: #343a40;
      --text-light: #6c757d;
      --white: #ffffff;
    }

    body {
                font-family: 'Roboto', sans-serif;
                background-color: #f9f9f9;
                color: #444;
                line-height: 1.7;
            }

    .breadcrumbs {
      background-color: var(--primary-light);
      padding: 15px 0;
      margin-bottom: 30px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .breadcrumbs p.bread {
      margin: 0;
      font-size: 16px;
      font-weight: 500;
    }

    .breadcrumbs a {
      color: var(--primary-dark);
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .breadcrumbs a:hover {
      color: var(--text-dark);
    }

    .search-filter-container {
      background-color: var(--white);
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.08);
      margin-bottom: 30px;
    }

    .search-input {
      border: 2px solid var(--primary-color);
      border-radius: 30px 0 0 30px;
      padding: 10px 20px;
      box-shadow: none;
      height: 45px;
    }

    .search-btn {
      background-color: var(--primary-color);
      border: 2px solid var(--primary-color);
      color: var(--text-dark);
      border-radius: 0 30px 30px 0;
      font-weight: 600;
      padding: 10px 25px;
      height: 45px;
    }

    .search-btn:hover {
      background-color: var(--primary-dark);
      border-color: var(--primary-dark);
      color: var(--white);
    }

    .form-check-input:checked {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }

    .form-check-label {
      cursor: pointer;
      padding-left: 5px;
    }

    .wrapper-dt {
      padding: 20px 0;
    }

    .col-dt {
      margin-bottom: 30px;
    }

    .item {
      background-color: var(--white);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 3px 15px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
      height: 100%;
      position: relative;
    }

    .item:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.12);
    }

    .product-lable {
      position: absolute;
      top: 10px;
      left: 0;
      z-index: 1;
    }

    .product-lable span {
      background-color: var(--primary-color);
      color: var(--text-dark);
      padding: 5px 10px;
      font-size: 14px;
      font-weight: 600;
      border-radius: 0 20px 20px 0;
      box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
    }

    .item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      transition: all 0.5s ease;
    }

    .item:hover img {
      transform: scale(1.05);
    }

    .item-info {
      padding: 15px;
    }

    .item-name {
      font-weight: 600;
      font-size: 16px;
      color: var(--text-dark);
      margin-bottom: 10px;
      padding: 0 15px;
      min-height: 60px; /* Thay đổi height thành min-height */
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 3; /* Tăng số dòng từ 2 lên 3 */
      -webkit-box-orient: vertical;
    }

    .item-price {
      padding: 0 15px 15px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .item-price p {
      color: var(--primary-dark);
      font-weight: 700;
      font-size: 18px;
      margin-bottom: 0;
    }

    .item-price h6 {
      color: var(--text-light);
      text-decoration: line-through;
      font-size: 14px;
      margin-top: 5px;
    }

    .xemthem {
      background-color: var(--white);
      color: var(--primary-dark);
      border: 2px solid var(--primary-color);
      border-radius: 30px;
      font-weight: 600;
      padding: 10px 30px;
      margin: 20px auto;
      transition: all 0.3s ease;
    }

    .xemthem:hover {
      background-color: var(--primary-color);
      color: var(--text-dark);
    }

    #loading {
      text-align: center;
      margin: 20px 0;
    }

    .no-products {
      text-align: center;
      padding: 40px 0;
      color: var(--text-light);
    }

    @media (max-width: 768px) {
      .col-dt {
        flex: 0 0 50%;
        max-width: 50%;
      }
    }

    @media (max-width: 576px) {
      .col-dt {
        flex: 0 0 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

<!-- Phần tìm kiếm và lọc -->
<div class="container">
  <div class="search-filter-container">
    <form class="mb-0" method="get">
      <input type="hidden" name="view" value="products">
      <div class="row align-items-center">
        <div class="col-md-6 mb-3 mb-md-0">
          <div class="input-group">
            <input type="text" name="key" class="form-control search-input" placeholder="Tìm kiếm sản phẩm..."
                 value="<?php echo htmlspecialchars($_GET['key'] ?? ''); ?>">
            <div class="input-group-append">
              <button type="submit" class="btn search-btn"><i class="fas fa-search mr-1"></i> Tìm kiếm</button>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-check d-flex align-items-center">
            <input class="form-check-input" type="checkbox" name="sort" id="sortAsc" value="asc"
              <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'asc') ? 'checked' : ''; ?>>
            <label class="form-check-label ml-2" for="sortAsc">
              <i class="fas fa-sort-amount-down-alt mr-1"></i> Giá thấp đến cao (không tính khuyến mãi)
            </label>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<?php
// Xử lý logic tìm kiếm và lọc
$key = isset($_GET['key']) ? trim($_GET['key']) : '';
$sort = isset($_GET['sort']) && $_GET['sort'] === 'asc' ? 'ASC' : '';

if ($key !== '') {
    // Tìm kiếm sản phẩm
    $product = product_search($key);
} elseif ($sort === 'ASC') {
    // Lọc giá tăng dần
    $product = product_all_sorted('ASC');
} else {
    // Mặc định hiển thị tất cả
    $product = productAll();
}

// Kiểm tra có sản phẩm không
$has_products = mysqli_num_rows($product) > 0;
?>

<div class="container">
  <div class="row wrapper-dt">
    <div class="col-12">
      <?php if($has_products): ?>
        <div class="row pad-dt">
          <?php while($row = mysqli_fetch_array($product)): ?>
          <div class="col-lg-3 col-md-4 col-sm-6 col-dt">
            <a href="?view=product-detail&id=<?php echo $row['MaSP'] ?>" class="text-decoration-none">
              <div class="item">
                <div class="product-lable">
                  <?php $price_sale = price_sale($row['MaSP'], $row['DonGia']);
                  if($price_sale < $row['DonGia']): ?>
                    <span><i class="fas fa-tag mr-1"></i> Giảm <?php echo number_format($row['DonGia'] - $price_sale); ?>đ</span>
                  <?php endif; ?>
                </div>
                <div class="item-image">
                  <img src="webroot/image/sanpham/<?php echo $row['AnhNen']; ?>" alt="<?php echo $row['TenSP']; ?>">
                </div>
                <div class="item-info">
                  <div class="item-name">
                    <p><?php echo $row['TenSP']; ?></p>
                  </div>
                  <div class="item-price">
                    <p><?php echo number_format($price_sale, 0); ?>đ</p>
                    <?php if(number_format($row['DonGia']) !== number_format($price_sale)): ?>
                      <h6><?php echo number_format($row['DonGia']); ?>đ</h6>
                    <?php endif; ?>
                    <div class="add-to-cart">
                                                <i class="fas fa-shopping-cart me-2"></i>Xem chi tiết
                                            </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <?php endwhile; ?>
          <div id="data_sp"></div>
        </div>
      <?php else: ?>
        <div class="no-products">
          <i class="fas fa-search fa-3x mb-3"></i>
          <h4>Không tìm thấy sản phẩm</h4>
          <p>Vui lòng thử lại với từ khóa khác hoặc xem tất cả sản phẩm.</p>
          <a href="?view=products" class="btn btn-outline-warning mt-2">Xem tất cả sản phẩm</a>
        </div>
      <?php endif; ?>
    </div>

    <div id="loading" style="display:none">
      <img src="webroot/image/loader.gif" alt="Loading...">
    </div>

    <?php if($has_products): ?>
    <form id="load_sp" class="w-100 text-center">
      <input type="hidden" name="page" id="page" value="1">
      <input type="hidden" name="rowCount" id="rowCount" value="12">
      <!-- Thêm các tham số filter vào form -->
      <input type="hidden" name="key" value="<?php echo htmlspecialchars($key); ?>">
      <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort); ?>">
      <button type="button" id="xemthem" class="btn xemthem">
        <i class="fas fa-sync-alt mr-1"></i> Xem thêm sản phẩm
      </button>
    </form>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script>
  // Auto-submit form when sort checkbox changes
  document.getElementById('sortAsc').addEventListener('change', function() {
    this.form.submit();
  });
</script>
</body>
</html>