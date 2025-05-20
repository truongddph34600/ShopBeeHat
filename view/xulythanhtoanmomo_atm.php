<?php
header('Content-type: text/html; charset=utf-8');

include('helper_momo.php');

$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

$orderInfo = "Thanh toán qua ATM MoMo";
// Đảm bảo amount là số nguyên, không có dấu phẩy hoặc dấu chấm
$amount = (int)$_POST['tongtien'];
// Đảm bảo amount tối thiểu là 10000 VND theo yêu cầu của MoMo
if ($amount < 10000) {
    $amount = 10000;
}

// Tạo orderId định dạng chuẩn
$orderId = time() . rand(100, 999);
$redirectUrl = "http://beehat.test/?view=order-complete";
$ipnUrl = "http://beehat.test/?view=order-complete";
$extraData = base64_encode("{}");

// Fix for first error: Check if extraData exists in $_POST
$requestId = time() . "";
$requestType = "payWithATM";
// Sửa lỗi: Kiểm tra $_POST["extraData"] tồn tại không
$extraData = (isset($_POST["extraData"]) && !empty($_POST["extraData"])) ? $_POST["extraData"] : "";

//before sign HMAC SHA256 signature
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);
$data = array('partnerCode' => $partnerCode,
    'partnerName' => "Test",
    "storeId" => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature);
// Nếu bạn muốn kiểm tra trước khi redirect
// echo "<h4>Dữ liệu gửi đi:</h4>";
// echo "<pre>";
// print_r($data);
// echo "</pre>";

$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);  // decode json

// echo "<h4>Dữ liệu nhận về:</h4>";
// echo "<pre>";
// print_r($jsonResult);
// echo "</pre>";

// Fix for second error: Check if payUrl exists in $jsonResult
if (isset($jsonResult['payUrl'])) {
    header('Location: ' . $jsonResult['payUrl']);
} else {
    // Xử lý khi không có payUrl
    echo "Lỗi khi kết nối đến MoMo: ";
    print_r($jsonResult); // In ra thông tin lỗi để debug
}
?>