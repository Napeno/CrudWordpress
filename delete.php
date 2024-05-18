<?php
// Install:
// composer require automattic/woocommerce

// Setup:
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

$woocommerce = new Client(
    'https://www.muchmade.id.vn', // Your store URL
    'ck_eecf7bf41059cfc863199c798aa6cc531f6520fc', // Your consumer key
    'cs_c92f287761ba6c1cdc8997673f752abde3763f1d', // Your consumer secret
    [
        'wp_api' => true, // Enable the WP REST API integration
        'version' => 'wc/v3' // WooCommerce WP REST API version
    ]
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $product_id = $_POST['id'];

    try {
        $woocommerce->delete("products/{$product_id}", ['force' => true]);
        echo "<img id='imgres2' src='/finish-01.png'>";
        echo "<p class='responseText'>Product deleted successfully.</p><br>";
    } catch (HttpClientException $e) {
        echo "Failed to create product: " . $e->getMessage() . "<br>";
        if ($e->getResponse()) {
            echo "Response: " . $e->getResponse() . "<br>";
        }
    }
} else {
    echo "Invalid request method.";
}
