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
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

    // SSL settings
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    //execute post
    $result = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch));
        curl_close($ch);
        return false;
    }

    //close connection
    curl_close($ch);
    return $result;
}

$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

// Thử endpoint backup nếu endpoint chính không hoạt động
$backup_endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

// Thông tin test mới nhất từ MoMo (2024)
$partnerCode = 'MOMO';
$accessKey = 'F8BBA842ECF85';
$secretKey = 'K951B6PE1waDMi640xX08PD3vg6EkVlz';

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

// INSERT vào bảng momo TRƯỚC KHI gửi request đến MoMo
$insert_result = false;
if (isset($conn)) { // Kiểm tra kết nối database tồn tại
    // Thêm code insert vào bảng momo ở đây
    // Ví dụ:
    $sql_momo = "INSERT INTO momo (order_id, amount, customer_id, status, created_at)
                 VALUES (?, ?, ?, 'pending', NOW())";

    if ($stmt = mysqli_prepare($conn, $sql_momo)) {
        mysqli_stmt_bind_param($stmt, "sis", $orderId, $amount, $customer_id);
        $insert_result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);

// Kiểm tra lỗi JSON decode
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "<h3>Lỗi xử lý phản hồi từ MoMo</h3>";
    echo "<p>Vui lòng thử lại sau.</p>";
    echo "<p><a href='javascript:history.back()'>Quay lại</a></p>";
    exit;
}

if (isset($jsonResult['payUrl']) && $jsonResult['resultCode'] == 0) {
    // Chuyển hướng đến trang thanh toán MoMo
    header('Location: ' . $jsonResult['payUrl']);
    exit;
} else {
    echo "<h3>Có lỗi xảy ra trong quá trình tạo thanh toán</h3>";

    if (isset($jsonResult['message'])) {
        echo "<p><strong>Thông báo:</strong> " . $jsonResult['message'] . "</p>";
    }

    if (isset($jsonResult['resultCode']) && $jsonResult['resultCode'] != 0) {
        echo "<p><strong>Mã lỗi:</strong> " . $jsonResult['resultCode'] . "</p>";
    }

    echo "<p>Vui lòng kiểm tra lại thông tin thanh toán.</p>";
    echo "<p><a href='javascript:history.back()'>Quay lại</a></p>";
}

// Chỉ tạo đơn hàng trong bảng hoadonmomo nếu insert vào bảng momo thành công
if($insert_result && isset($conn)) {
    // Lấy MaKH từ session
    $maKH = isset($_SESSION['MaKH']) ? $_SESSION['MaKH'] : null;

    if ($maKH) {
        // Tạo đơn hàng mới trong bảng hoadonmomo
        $order_data = array(
            'MaKH' => $maKH,
            'MaMomo' => mysqli_insert_id($conn), // Lấy MaMomo vừa insert
            'NgayDat' => date('Y-m-d H:i:s'),
            'TinhTrang' => 'Chờ thanh toán',
            'TongTien' => $amount
        );
        $sql = "INSERT INTO hoadonmomo (MaKH, MaMomo, NgayDat, TinhTrang, TongTien)
                VALUES (?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "iissd",
                $order_data['MaKH'],
                $order_data['MaMomo'],
                $order_data['NgayDat'],
                $order_data['TinhTrang'],
                $order_data['TongTien']
            );

            if (mysqli_stmt_execute($stmt)) {
                // Thành công
                error_log("Đơn hàng MoMo đã được tạo thành công. Order ID: " . $orderId);
            } else {
                error_log("Lỗi khi tạo đơn hàng MoMo: " . mysqli_error($conn));
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        error_log("Không tìm thấy MaKH trong session");
    }
}
?>