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

$orderId = time() . "";
$orderInfo = "Thanh toán qua MoMo";
$redirectUrl = "http://beehat.test/?view=order-complete";
$ipnUrl = "http://beehat.test/?view=order-complete";
$extraData = "";

$requestId = time() . "";
$requestType = "captureWallet";

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
?>