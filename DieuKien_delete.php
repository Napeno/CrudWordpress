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

$per_page = 100; // Increase the number of products to retrieve per page
$page = 1;
$out_of_stock_products = [];

do {
    $products = $woocommerce->get('products', [
        'per_page' => $per_page,
        'page'     => $page,
        'stock_status' => 'outofstock'
    ]);

    if (!empty($products)) {
        $out_of_stock_products = array_merge($out_of_stock_products, $products);
    }

    $page++;
} while (!empty($products));

$output = '';

if (!empty($out_of_stock_products)) {
    foreach ($out_of_stock_products as $product) {
        // Delete the out-of-stock products
        $response = $woocommerce->delete('products/' . $product->id, ['force' => true]);
        if ($response->status == 'trash') {
            $output .= "Failed to delete product: " . $product->name . " (ID: " . $product->id . ")\n";
        } else {
            $output .= "<p class='responseText'>Deleted product: " . $product->name . " (ID: " . $product->id . ")</p>\n";
        }
    }
} else {
    $output = "<p class='responseText'>No out-of-stock products found.</p>";
}

echo nl2br($output);
?>
