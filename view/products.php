<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="?view">Trang Chủ</a></span> / <span>Tất cả sản phẩm</span></p>
            </div>
        </div>
    </div>
</div>

<!-- Phần tìm kiếm và lọc mới thêm -->
<div class="container my-4">
  <div class="row">
    <form class="form-inline w-100 mb-3" method="get">
      <input type="hidden" name="view" value="products">
      <div class="form-group mr-2">
        <input type="text" name="key" class="form-control" placeholder="Tìm kiếm sản phẩm"
               value="<?php echo htmlspecialchars($_GET['key'] ?? ''); ?>">
      </div>
  <div class="form-check">
          <input class="form-check-input" type="checkbox" name="sort" id="sortAsc" value="asc"
            <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'asc') ? 'checked' : ''; ?>>
          <label class="form-check-label" for="sortAsc">Giá thấp đến cao ( không tính khuyến mãi )</label>
        </div>
      <button type="submit" class="btn btn-primary mr-3">Tìm kiếm</button>

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
?>

<div class="container ">
  <div class="row wrapper-dt">
      <div class="col-12">
        <div class="row pad-dt">
          <div class="row pad-dt">
            <?php while($row = mysqli_fetch_array($product)): ?>
            <div class="col-3 col-dt">
              <a href="?view=product-detail&id=<?php echo $row['MaSP'] ?>">
                <div class="item">
                  <div class="product-lable">
                    <?php $price_sale = price_sale($row['MaSP'], $row['DonGia']);
                    if($price_sale < $row['DonGia']): ?>
                      <span>Giảm <?php echo number_format($row['DonGia'] - $price_sale); ?>đ</span>
                    <?php endif; ?>
                  </div>
                  <div><img src="webroot/image/sanpham/<?php echo $row['AnhNen']; ?>"></div>
                  <div class="item-name"><p><?php echo $row['TenSP']; ?></p></div>
                  <div class="item-price">
                    <p><?php echo number_format($price_sale, 0); ?>đ</p>
                    <?php if(number_format($row['DonGia']) !== number_format($price_sale)): ?>
                      <h6><?php echo number_format($row['DonGia']); ?>đ</h6>
                    <?php endif; ?>
                  </div>
                </div>
              </a>
            </div>
            <?php endwhile; ?>
            <div id="data_sp"></div>
          </div>
        </div>
      </div>
      <div id="loading" style="display:none">
        <img src="webroot/image/loader.gif" alt="Loading...">
      </div>

      <form id="load_sp" class="row">
          <input type="hidden" name="page" id="page" value="1">
          <input type="hidden" name="rowCount" id="rowCount" value="10">
          <!-- Thêm các tham số filter vào form -->
          <input type="hidden" name="key" value="<?php echo htmlspecialchars($key); ?>">
          <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort); ?>">
          <button type="button" id="xemthem" class="btn btn-outline-secondary xemthem mx-auto col-2">xem thêm</button>
      </form>
  </div>
</div>