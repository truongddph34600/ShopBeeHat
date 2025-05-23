<?php
header('Content-type: text/html; charset=utf-8');

function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

// Xử lý số tiền đúng cách - loại bỏ dấu phẩy nếu có và đảm bảo là số nguyên
$rawAmount = $_POST['tongtien'];
// Loại bỏ tất cả các dấu phẩy, dấu chấm và ký tự không phải số
$cleanAmount = preg_replace('/[^0-9]/', '', $rawAmount);
$amount = (int)$cleanAmount;

// Kiểm tra số tiền tối thiểu
if ($amount < 1000) {
    echo "Số tiền thanh toán tối thiểu phải là 1.000 VND. Hiện tại: " . number_format($amount) . " VND";
    exit;
}

// Lấy thông tin đơn hàng nếu đã lưu trong session (nếu cần)
session_start();
$customer_id = isset($_SESSION['laclac_khachang']['MaKH']) ? $_SESSION['laclac_khachang']['MaKH'] : 'KH' . time();

$orderId = time() . "";
$orderInfo = "Thanh toán đơn hàng #" . $orderId;
$redirectUrl = "http://beehat.test/?view=order-complete"; // URL khi thanh toán xong
$ipnUrl = "http://beehat.test/?view=order-complete";      // URL nhận IPN từ MoMo
$extraData = $customer_id;                                // Lưu thêm thông tin khách hàng nếu cần

$requestId = time() . "";
$requestType = "captureWallet"; // Loại thanh toán QR code

// Tạo chuỗi rawHash theo đúng thứ tự như tài liệu MoMo yêu cầu
$rawHash = "accessKey=" . $accessKey .
        "&amount=" . $amount .
        "&extraData=" . $extraData .
        "&ipnUrl=" . $ipnUrl .
        "&orderId=" . $orderId .
        "&orderInfo=" . $orderInfo .
        "&partnerCode=" . $partnerCode .
        "&redirectUrl=" . $redirectUrl .
        "&requestId=" . $requestId .
        "&requestType=" . $requestType;

$signature = hash_hmac("sha256", $rawHash, $secretKey);

// Chuẩn bị dữ liệu theo đúng format mà API yêu cầu
$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    'storeId' => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);

// Debug thông tin
echo "<h3>Số tiền gửi đến MoMo: " . number_format($amount) . " VND</h3>";

// Lưu thông tin vào session để sau này có thể kiểm tra
$_SESSION['momo_payment'] = [
    'order_id' => $orderId,
    'amount' => $amount,
    'order_info' => $orderInfo,
    'customer_id' => $customer_id,
    'time' => date('Y-m-d H:i:s')
];

$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);

if (isset($jsonResult['payUrl'])) {
    header('Location: ' . $jsonResult['payUrl']);
    exit;
} else {
    echo "<h3>Lỗi từ MoMo:</h3>";
    echo "<pre>";
    print_r($jsonResult);
    echo "</pre>";

    echo "<p>Vui lòng kiểm tra lại thông tin thanh toán.</p>";
    echo "<p><a href='javascript:history.back()'>Quay lại</a></p>";
}
if($insert_result) {  // Giả sử $insert_result là kết quả insert vào bảng momo
    // Tạo đơn hàng mới trong bảng hoadonmomo
    $order_data = array(
        'MaKH' => $_SESSION['MaKH'], // Giả sử đã có session chứa MaKH
        'MaMomo' => mysqli_insert_id($conn), // Lấy MaMomo vừa insert
        'NgayDat' => date('Y-m-d H:i:s'),
        'TinhTrang' => 'Chờ thanh toán',
        'TongTien' => $amount  // Số tiền thanh toán từ form
    );

    $sql = "INSERT INTO hoadonmomo (MaKH, MaMomo, NgayDat, TinhTrang, TongTien)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iissd",
        $order_data['MaKH'],
        $order_data['MaMomo'],
        $order_data['NgayDat'],
        $order_data['TinhTrang'],
        $order_data['TongTien']
    );

    mysqli_stmt_execute($stmt);
}
?>