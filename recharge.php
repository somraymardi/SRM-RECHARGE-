<?php
include 'includes/config.php';

// Example inputs
$mobile = $_POST['mobile'] ?? '';
$operator_id = $_POST['operator_id'] ?? '';
$amount = $_POST['amount'] ?? '';
$api_key = 'your_kwikapi_key_here';

if ($mobile && $operator_id && $amount) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.kwikapi.com/api/v2/recharge.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'api_key' => $api_key,
        'number' => $mobile,
        'amount' => $amount,
        'opid' => $operator_id,
        'client_id' => uniqid()
    ]);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo $response;
    }
    curl_close($ch);
} else {
    echo "Invalid input.";
}
?>