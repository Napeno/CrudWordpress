<?php
// Install:
// composer require automattic/woocommerce

// Setup:
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'https://www.muchmade.id.vn', // Your store URL
    'ck_eecf7bf41059cfc863199c798aa6cc531f6520fc', // Your consumer key
    'cs_c92f287761ba6c1cdc8997673f752abde3763f1d', // Your consumer secret
    [
        'wp_api' => true, // Enable the WP REST API integration
        'version' => 'wc/v3' // WooCommerce WP REST API version
    ]
);

$today = new DateTime(); // Current date
$dayOfMonth = $today->format('d'); // Day of the month

// Check if the current date matches the specified day (e.g., 16th of every month)
if ($dayOfMonth === '16') {
    $products = $woocommerce->get('products');

    foreach ($products as $product) {
        $product_id = 325;
        $regular_price = floatval($product->regular_price); // Cast regular_price to float
        $sale_price = $regular_price * 0.5;

        // Update the product data
        $data = [
            'regular_price' => (string) $regular_price,
            'sale_price' => (string) $sale_price
        ];

        // Send a PUT request to update the product
        $woocommerce->put("products/{$product_id}", $data);
    }

    echo "Product prices updated successfully!";
} else {
    echo "Today is not the specified discount day.";
}
