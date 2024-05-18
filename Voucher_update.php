<?php
// Setup the WooCommerce client
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

$woocommerce = new Client(
    'https://www.muchmade.id.vn',
    'ck_eecf7bf41059cfc863199c798aa6cc531f6520fc',
    'cs_c92f287761ba6c1cdc8997673f752abde3763f1d',
    [
        'wp_api' => true,
        'version' => 'wc/v3'
    ]
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $voucher_id = $_POST['idvoucher'];
    $voucher_name = $_POST['namevoucher'];
    $voucher_amount = $_POST['amountvoucher'];
    $voucher_minimum_amount = $_POST['minimum_amountvoucher'];
    $voucher_expiry_date = $_POST['expiry_datevoucher'];

    $updated_voucher_data = [
        'code' => $voucher_name,
        'discount_type' => 'percent',
        'amount' => $voucher_amount,
        'individual_use' => true,
        'exclude_sale_items' => true,
        'minimum_amount' => $voucher_minimum_amount,
        'expiry_date' => $voucher_expiry_date
    ];

    try {
        $response = $woocommerce->put('coupons/' . $voucher_id, $updated_voucher_data);
        echo "<img id='imgres6' src='/finish-01.png'>";
        echo "<p class='responseText'>Voucher updated successfully.</p><br>";
    } catch (HttpClientException $e) {
        echo "Failed to update voucher: " . $e->getMessage() . "<br>";
        if ($e->getResponse()) {
            echo "Response: " . $e->getResponse() . "<br>";
        }
    }
} else {
    echo "Invalid request method.";
}