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
    // Get form data
    $voucher_id = $_POST['idV'];

    try {
        $woocommerce->delete('coupons/' . $voucher_id, ['force' => true]);
        echo "Voucher deleted successfully.<br>";
    } catch (HttpClientException $e) {
        echo "Failed to create product: " . $e->getMessage() . "<br>";
        if ($e->getResponse()) {
            echo "Response: " . $e->getResponse() . "<br>";
        }
    }
} else {
    echo "Invalid request method.";
}