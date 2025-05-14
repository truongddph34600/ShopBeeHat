<?php
// kết nối database
    $servername = "localhost";
    $database = "beehat";
    $username = "root";
    $password = "";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

// -------------------------
function selectdata($sql)
{
    global $conn;
    $retval = mysqli_query(  $conn ,$sql);
    return $retval;
    mysqli_close($conn);
}
// login
function checklogin($email,$password){
    global $conn;
    $sql="SELECT * FROM `khachhang` WHERE Email= '$email' AND MatKhau = '$password'";
    $resulf=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($resulf);
    if($count==0){
        return false;
      }else{
        return $resulf;
      }
    mysqli_close($conn);
}
// -------------------------
// ------------------------------------------ PRODUCT MODEL----------------------
// lấy danh sách sản phẩm
function productAll(){
  global $conn;
  $sql=" SELECT * FROM `sanpham`  limit 12" ;
  $resulf=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return  $resulf;
    }
  mysqli_close($conn);
}
// lấy danh sách sản phẩn nổi bật
function featuredProductsL4(){
  global $conn;
  $sql = "SELECT * FROM `sanpham` WHERE `MaDM` = 1 LIMIT 4";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);
  if ($count == 0) {
      return false;
  } else {
      return $result;
  }
  mysqli_close($conn);
}
function newsProductsL4(){
  global $conn;
  $sql = "SELECT * FROM `sanpham` WHERE `MaDM` = 2 LIMIT 4 ";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);
  if ($count == 0) {
      return false;
  } else {
      return $result;
  }
  mysqli_close($conn);
}
function sellingProductsL4(){
  global $conn;
  $sql = "SELECT * FROM `sanpham` WHERE `MaDM` = 3 LIMIT 4";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);
  if ($count == 0) {
      return false;
  } else {
      return $result;
  }
  mysqli_close($conn);
}

// lấy danh sách sản phẩm random
function product_rand(){
  global $conn;
  $sql=" SELECT * FROM `sanpham` ORDER BY rand() limit 4" ;
  $resulf=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return  $resulf;
    }
  mysqli_close($conn);
}
// tìm kiếm sản phẩm
function product_search($key){
  global $conn;
  $sql="SELECT * FROM `sanpham` WHERE `TenSP`  LIKE N'%".$key."%' ";
  $resulf=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return  $resulf;
    }
  mysqli_close($conn);
}
// lấy 1 product
function product($id){
  global $conn;
  $sql="SELECT * FROM sanpham WHERE `MaSP` = $id";
  $resulf=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return  $resulf;
    }
  mysqli_close($conn);
}
// tính sản phẩm khuyến mãi
function price_sale($id,$gia){
  global $conn;
  $a=0; $b=0;$tong=0;
  date_default_timezone_set('Asia/Ho_Chi_Minh');$date=getdate();
	$ngay=$date['year']."-".$date['mon']."-".($date['mday']);

  $km="SELECT * FROM `sanphamkhuyenmai` WHERE `MaSP`=".$id;
  $query_km=mysqli_query($conn,$km);
  while ($kq_km=mysqli_fetch_array($query_km)) {
    $km1="SELECT * FROM `khuyenmai` WHERE `MaKM`=".$kq_km['MaKM']." and NgayBD <='".$ngay."' and NgayKT >='".$ngay."'";
      $query_km1=mysqli_query($conn,$km1);
      while ($kq_km=mysqli_fetch_array($query_km1)) {
           if(isset($kq_km['KM_PT'])){ $b=$b+($kq_km['KM_PT']);}
           if(isset($kq_km['TienKM'])){ $a=$a+($kq_km['TienKM']);}
      }
  }
  if ($a!==0 && $b!==0) {
    return  $tong = $gia - $a - ($gia*$b/100);
  }elseif($b==0){
    return $tong=$gia-$a;
  }elseif($a==0){
    return $tong=$gia-($gia*$b/100);
  }else{
    return $gia;
  }
  mysqli_close($conn);
}
// lấy  product detail
function product_detail_color($id){
  global $conn;
  $sql="SELECT  DISTINCT MaMau FROM `chitietsanpham` WHERE  `MaSP` = $id";
  $resulf=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return  $resulf;
    }
  mysqli_close($conn);
}
function product_detail_size($id){
  global $conn;
  $sql="SELECT  DISTINCT MaSize FROM `chitietsanpham` WHERE  `MaSP` = $id";
  $resulf=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return  $resulf;
    }
  mysqli_close($conn);
}
function product_detail_image($id){
  global $conn;
  $sql="SELECT  * FROM `anhsp` WHERE  `MaSP` = $id";
  $resulf=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return  $resulf;
    }
  mysqli_close($conn);
}
// check số lượgn prodcut
function check_product_soluong($id, $size, $mau) {
  global $conn;

  // Chuẩn bị câu lệnh SQL để tránh SQL Injection
  $sql = "SELECT SoLuong FROM chitietsanpham WHERE MaSP = ? AND MaMau = ? AND MaSize = ?";

  // Chuẩn bị câu lệnh
  if ($stmt = mysqli_prepare($conn, $sql)) {
      // Liên kết tham số với câu lệnh
      mysqli_stmt_bind_param($stmt, "iss", $id, $mau, $size); // 'i' cho int, 's' cho string

      // Thực thi câu lệnh
      mysqli_stmt_execute($stmt);

      // Lấy kết quả trả về
      $result = mysqli_stmt_get_result($stmt);

      // Kiểm tra nếu có dữ liệu
      if (mysqli_num_rows($result) == 0) {
          return 0;  // Không có dữ liệu
      } else {
          // Lấy dữ liệu từ kết quả
          $row = mysqli_fetch_array($result);
          return $row['SoLuong'];  // Trả về số lượng
      }

      // Đóng câu lệnh
      mysqli_stmt_close($stmt);
  } else {
      // Nếu có lỗi trong việc chuẩn bị câu lệnh SQL
      return 0;
  }

  // Đóng kết nối
  mysqli_close($conn);
}

// check phiếu giảm giá
if (isset($_POST["functionName"])) {
  if ($_POST["functionName"] == "check_coupon") {
    $id = $_POST["id"];
    $result = check_coupon($id);
    echo json_encode($result);
  }
}
function check_coupon($id){
  global $conn;
  $sql="SELECT * FROM `phieugiamgia` WHERE `id` = '$id'";
  $resulf = mysqli_query($conn ,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
    return $coupon=0;
  }else{
    $coupon=mysqli_fetch_array($resulf);
    return number_format( $coupon['SoTien']);
  }
mysqli_close($conn);
}
// các bình luận product
function product_review($id){
  global $conn;
  $sql="SELECT * FROM `binhluan` WHERE `MaSP`=$id ORDER BY ThoiGian DESC ";
  $resulf = mysqli_query($conn ,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return  $resulf;
    }
  mysqli_close($conn);

}
// thêm bình luận product
function product_addtoreview($masp,$id,$nd){
  global $conn;
  $sql="INSERT INTO `binhluan`( `MaSP`, `MaKH`, `NoiDung`) VALUES('$masp',".$id.",'$nd')";
  $resulf = mysqli_query($conn ,$sql);
  if($resulf){
      return true;
    }else{
      return  false;
    }
  mysqli_close($conn);
}
/////// tải thêm nhiều sản phẩm với ajax
if (isset($_POST['page'])==true) {
  $page = $_POST['page']*12;
  $row_count = $_POST['rowCount'];
  $sql="SELECT * FROM `sanpham`  limit 12,".$page;
  $res=selectdata($sql); ?>
  <div class="row pad-dt"><?php  while( $row=mysqli_fetch_array($res)){ ?>
    <div class="col-3 col-dt">
      <a href="?view=product-detail&id=<?php echo $row['MaSP'] ?>">
        <div class="item">
          <div class="product-lable">
            <?php $price_sale=price_sale($row['MaSP'],$row['DonGia']); if($price_sale < $row['DonGia']) {
              echo '<span>Giảm '.number_format( $row['DonGia'] - $price_sale).'đ </span>';}?>
          </div>
          <div><img src="webroot/image/sanpham/<?php echo $row['AnhNen']; ?>"></div>
          <div class="item-name"><p> <?php echo $row['TenSP']; ?> </p></div>
          <div class="item-price">
            <p> <?php echo number_format($price_sale,0).'đ'; ?> </p>
            <h6> <?php if(number_format($row['DonGia']) !== number_format($price_sale)) {echo number_format($row['DonGia']).'đ';} ;  ?> </h6>
          </div>
        </div>
      </a>
      </div><?php }  ?>
  </div>
<?php
};


// ------------------------------------------ Category MODEL----------------------
// danh mục
function categorys(){
  global $conn;
  $sql=" SELECT * FROM `nhacc` ";
  $resulf=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($resulf);
    if($count==0){
        return false;
      }else{
        return  $resulf;
      }
    mysqli_close($conn);
}
// lấy danh sách sản phẩm theo danh mục
function product_category($id){
  global $conn;
  $sql=" SELECT * FROM `sanpham` where MaNCC = $id" ;
  $resulf=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return  $resulf;
    }
  mysqli_close($conn);
}

// -------------------------------------------------------------------------------
// ------------------------------------------ card MODEL----------------------
// xử lý đặt hàng

function order_product($nn, $dcnn, $sdtnn, $makh, $tt) {
  global $conn;

  // Kiểm tra và xử lý các giá trị đầu vào
  $nn = mysqli_real_escape_string($conn, $nn); // Xử lý tên người nhận
  $dcnn = mysqli_real_escape_string($conn, $dcnn); // Xử lý địa chỉ người nhận
  $sdtnn = mysqli_real_escape_string($conn, $sdtnn); // Xử lý số điện thoại người nhận
  $makh = (int)$makh; // Chuyển mã khách hàng thành số nguyên
  $tt = (float)str_replace(',', '', $tt); // Đảm bảo tổng tiền là số thực, bỏ dấu phẩy nếu có

  // Thực hiện câu lệnh SQL insert vào bảng hoadon
  $sql = "INSERT INTO `hoadon`(`MaKH`, `TinhTrang`, `TongTien`) VALUES ($makh, N'chưa duyệt', $tt)";
  $resulf = mysqli_query($conn, $sql);

  if ($resulf) {
      // Lấy mã hóa đơn mới nhất
      $sql2 = "SELECT MaHD FROM hoadon WHERE MaKH = $makh AND TongTien = $tt ORDER BY MaHD DESC LIMIT 1";
      $rs2 = mysqli_query($conn, $sql2);
      $kq2 = mysqli_fetch_array($rs2);
      $mahd = $kq2['MaHD'];

      // Duyệt qua các sản phẩm trong giỏ hàng và thêm vào bảng chi tiết hóa đơn
      foreach ($_SESSION['cart_product'] as $item) {
          $DonGia = str_replace(',', '', $item['DonGia']); // Xử lý giá trị đơn giá, bỏ dấu phẩy nếu có
          $ttt = ($item['SoLuong'] * $DonGia); // Tính thành tiền
          $masp = (int)$item['MaSP']; // Mã sản phẩm
          $sl = (int)$item['SoLuong']; // Số lượng
          $dg = (float)$DonGia; // Đảm bảo giá trị đơn giá là số thực
          $mamau = mysqli_real_escape_string($conn, $item['Mau']); // Mã màu
          $size = mysqli_real_escape_string($conn, $item['Size']); // Kích cỡ

          // Thêm chi tiết hóa đơn
          $sql3 = "INSERT INTO `chitiethoadon`(`MaHD`, `MaSP`, `SoLuong`, `DonGia`, `ThanhTien`, `Size`, `MaMau`)
                   VALUES ($mahd, $masp, $sl, $dg, $ttt, '$size', '$mamau')";
          $rs3 = mysqli_query($conn, $sql3);

          // Cập nhật số lượng sản phẩm trong kho
          $sql_sl = "UPDATE `chitietsanpham` SET `SoLuong` = `SoLuong` - '$sl'
                     WHERE `MaSP` = '$masp' AND `MaSize` = '$size' AND `MaMau` = '$mamau'";
          $rs_sl = mysqli_query($conn, $sql_sl);
      }

      if ($rs3 && $rs_sl) {
          // Thêm thông tin người nhận vào bảng nguoinhan
          $sql4 = "INSERT INTO `nguoinhan`(`MaHD`, `TenNN`, `DiaChiNN`, `SDTNN`)
                   VALUES ($mahd, '$nn', '$dcnn', '$sdtnn')";
          $rs4 = mysqli_query($conn, $sql4);

          if ($rs4) {
              // Xóa giỏ hàng nếu đơn hàng được đặt thành công
              unset($_SESSION['cart_product']);
              return true;
          } else {
              return false;
          }
      }
  }

  return false;
}



// -------------------------------------------------------------------------------
// ------------------------------------------ user MODEL----------------------
// đăng ký mới
function newUser($name,$email,$sdt,$address,$password){
  global $conn;
  $sql="INSERT INTO `khachhang`( `TenKH`, `Email`, `SDT`, `DiaChi`, `MatKhau`) VALUES ('$name','$email','$sdt','$address','$password')";
  $resulf=mysqli_query($conn,$sql);
  if($resulf){
      return true;
    }else{
      return false;
    }
  mysqli_close($conn);
}
// -------------------------
// select khách hàng
function selectKH($id){
  global $conn;
  $sql="SELECT * FROM khachhang WHERE MaKH = $id";
  $resulf=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return mysqli_fetch_array($resulf);
    }
  mysqli_close($conn);
}
// -------------------------

// update khách hàng
function update_user($id,$ten,$sdt,$dc,$matkhau){
  global $conn;
  $sql="UPDATE `khachhang` SET `TenKH`='$ten',`SDT`=$sdt,`DiaChi`='$dc',`MatKhau`='$matkhau' WHERE `MaKH`=$id";
  $resulf=mysqli_query($conn,$sql);
  return $resulf;
  mysqli_close($conn);
}
// -------------------------
// đơn hàng của khách hàng
function bill_user($id){
  global $conn;
  $sql="SELECT * FROM `hoadon` WHERE MaKH = $id ORDER BY NgayDat DESC";
  $resulf=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return $resulf;
    }
  mysqli_close($conn);
}
// -------------------------------------------------------------------------------
// ------------------------------------------ admin  ----------------------
// chi tiết hóa đơn
function bill_detail($id){
  global $conn;
  $sql="SELECT * FROM chitiethoadon WHERE MaHD = $id" ;
  $resulf=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($resulf);
  if($count==0){
      return false;
    }else{
      return $resulf;
    }
  mysqli_close($conn);
}

// -------------------------------------------------------------------------------
?>



