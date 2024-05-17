<?php
// Setup the WooCommerce client
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;
$woocommerce = new Client(
    'https://www.muchmade.id.vn',
    'ck_eecf7bf41059cfc863199c798aa6cc531f6520fc',
    'cs_c92f287761ba6c1cdc8997673f752abde3763f1d',
    [
        'wp_api' => true,
        'version' => 'wc/v3'
    ]
);

// Retrieve all vouchers
$vouchers = $woocommerce->get('coupons', [
    'per_page' => 100, // Adjust the number of vouchers to retrieve per page
    'page' => 1 // Start with the first page
]);

// Output vouchers as JSON
header('Content-Type: application/json');
echo json_encode($vouchers);
?>
