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
<div class="container my-4">
  <div class="row">
    <!-- Thanh tìm kiếm và lọc giá -->
    <form class="form-inline w-100 mb-3" method="get">
      <input type="hidden" name="view" value="products-category">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
      <div class="form-group mr-2">
        <input type="text" name="key" class="form-control" placeholder="Tìm kiếm sản phẩm"
               value="<?php echo htmlspecialchars($key); ?>">
      </div>
      <button type="submit" class="btn btn-primary mr-3">Tìm kiếm</button>
    </form>
  </div>
</div>

<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="?view">Trang Chủ</a></span> / <span>Sản phẩm</span></p>
            </div>
        </div>
    </div>
</div>
<div class="colorlib-product">
    <div class="container">
        <div class="row wrapper-dt">
            <div class="col-12">
                <div class="row pad-dt">
                    <?php while ($row = mysqli_fetch_array($products)) {
                        $price_sale = price_sale($row['MaSP'], $row['DonGia']); ?>
                        <div class="col-3 col-dt">
                            <a href="?view=product-detail&id=<?php echo $row['MaSP']; ?>">
                                <div class="item">
                                    <div class="product-lable">
                                        <?php if ($price_sale < $row['DonGia']) {
                                            echo '<span>Giảm ' . number_format($row['DonGia'] - $price_sale) . 'đ</span>';
                                        } ?>
                                    </div>
                                    <div><img src="webroot/image/sanpham/<?php echo $row['AnhNen']; ?>"></div>
                                    <div class="item-name"><p><?php echo $row['TenSP']; ?></p></div>
                                    <div class="item-price">
                                        <p><?php echo number_format($price_sale, 0) . 'đ'; ?></p>
                                        <h6><?php if (number_format($row['DonGia']) !== number_format($price_sale)) {
                                            echo number_format($row['DonGia']) . 'đ';
                                        } ?></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flexslider">
    <img src="webroot/image/slider/brand-2.jpg" alt="" width="100%" height="50%">
</div>
<div class="flexslider">
    <h2 class="text-center">SPONSORSHIP</h2>
    <p class="text-center">Ngắm nhìn những bức ảnh từ khách hàng của chúng tôi</p>
    <div class="row justify-content-center">
        <?php for ($i = 1; $i <= 5; $i++) { ?>
            <div class="col-6 col-sm-4 col-md-2 p-2">
                <img src="webroot/image/brand/spon<?php echo $i; ?>.jpeg" class="img-fluid" alt="Sponsor <?php echo $i; ?>">
            </div>
        <?php } ?>
    </div>
</div>
