<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hoàn thành mua hàng</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #ffc107;
      --primary-hover: #2da89a;
      --secondary-color: #f8f9fa;
      --text-color: #444;
      --light-text: #888;
      --dark-text: #222;
      --success-color: #28a745;
    }

    body {
                font-family: 'Roboto', sans-serif;
                background-color: #f9f9f9;
                color: #444;
                line-height: 1.7;
            }

    .breadcrumbs {
      background-color: var(--secondary-color);
      padding: 12px 0;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .bread {
      font-size: 14px;
      margin-bottom: 0;
      color: var(--light-text);
    }

    .bread a {
      color: var(--primary-color);
      text-decoration: none;
      transition: color 0.3s;
    }

    .bread a:hover {
      color: var(--primary-hover);
      text-decoration: underline;
    }

    .colorlib-product {
      padding: 40px 0 60px;
    }

    .process-wrap {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin-bottom: 50px;
    }

    .process-wrap::before {
      content: '';
      position: absolute;
      top: 35px;
      left: 15%;
      width: 70%;
      height: 2px;
      background-color: #e6e6e6;
      z-index: 0;
    }

    .process {
      position: relative;
      z-index: 1;
      width: 33.33%;
    }

    .process p {
      margin-bottom: 0;
    }

    .process span {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background-color: #e6e6e6;
      color: var(--light-text);
      font-size: 20px;
      font-weight: 600;
      margin: 0 auto 10px;
      transition: all 0.3s;
    }

    .process h3 {
      font-size: 16px;
      font-weight: 500;
      color: var(--light-text);
      transition: all 0.3s;
    }

    .process.active span {
      background-color: var(--primary-color);
      color: white;
      box-shadow: 0 5px 15px rgba(61, 186, 171, 0.3);
    }

    .process.active h3 {
      color: var(--dark-text);
      font-weight: 600;
    }

    .icon-addcart {
      margin: 30px 0;
    }

    .icon-addcart span {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background-color: var(--success-color);
      color: white;
      font-size: 36px;
      margin: 0 auto 20px;
      box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
        box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
      }
      50% {
        transform: scale(1.05);
        box-shadow: 0 15px 30px rgba(40, 167, 69, 0.4);
      }
      100% {
        transform: scale(1);
        box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
      }
    }

    .order-complete {
      text-align: center;
      padding: 20px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    h2.mb-4 {
      font-size: 24px;
      font-weight: 600;
      color: var(--dark-text);
      margin-bottom: 25px !important;
    }

    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      border-radius: 30px;
      padding: 12px 30px;
      font-weight: 500;
      letter-spacing: 0.5px;
      transition: all 0.3s;
      text-transform: uppercase;
      font-size: 14px;
    }

    .btn-primary:hover {
      background-color: var(--primary-hover);
      border-color: var(--primary-hover);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(61, 186, 171, 0.3);
    }

    .btn-outline-primary {
      color: var(--primary-color);
      background-color: transparent;
      border-color: var(--primary-color);
    }

    .btn-outline-primary:hover {
      color: white;
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }
  </style>
</head>
<body>
  <!-- Breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col">
          <p class="bread"><span><a href="index.html">Home</a></span> / <span>HOÀN THÀNH MUA HÀNG</span></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="colorlib-product">
    <div class="container">
      <!-- Progress Steps -->
      <div class="row row-pb-lg">
        <div class="col-sm-10 offset-md-1">
          <div class="process-wrap">
            <div class="process text-center active">
              <p><span>01</span></p>
              <h3>Giỏ hàng</h3>
            </div>
            <div class="process text-center active">
              <p><span>02</span></p>
              <h3>Thanh toán</h3>
            </div>
            <div class="process text-center active">
              <p><span>03</span></p>
              <h3>Hoàn thành</h3>
            </div>
          </div>
        </div>
      </div>

      <!-- Success Message -->
      <div class="row">
        <div class="col-sm-10 offset-sm-1">
          <div class="order-complete">
            <p class="icon-addcart"><span><i class="fas fa-check"></i></span></p>
            <h2 class="mb-4">Cảm ơn bạn đã mua hàng!</h2>
            <p class="mb-4">Đơn hàng của bạn đã được xác nhận và sẽ được xử lý trong thời gian sớm nhất.</p>
            <p>
              <a href="?view" class="btn btn-primary">Tiếp tục mua sắm</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>