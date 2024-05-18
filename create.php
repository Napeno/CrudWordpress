<?php
// Install:
// composer require automattic/woocommerce

// Setup:
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

$woocommerce = new Client(
    'https://www.muchmade.id.vn', // Your store URL
    'ck_8836b8f5dda3d82c539ca8de2c7085070fd0b047', // Your consumer key
    'cs_66067fce0de5d61ad3225fd2a9bca9fed6d59c19', // Your consumer secret
    [
        'wp_api' => true, // Enable the WP REST API integration
        'version' => 'wc/v3' // WooCommerce WP REST API version
    ]
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $product_name = $_POST['name'];
    $product_price = $_POST['regular_price'];
    $product_Sprice = $_POST['sale_price'];
    $product_description = $_POST['description'];

    $data = [
        'name' => $product_name,
        'type' => 'simple',
        'regular_price' => $product_price,
        'sale_price' => $product_Sprice,
        'description' => $product_description
        // Add more fields as needed
    ];

    try {
        $newProduct = $woocommerce->post('products', $data);
        echo "<img id='imgres1' src='/finish-01.png'>";
        echo "<p class='responseText'>New product created successfully!</p><br>";
    } catch (HttpClientException $e) {
        echo "Failed to create product: " . $e->getMessage() . "<br>";
        if ($e->getResponse()) {
            echo "Response: " . $e->getResponse() . "<br>";
        }
    }
} else {
    echo "Invalid request method.";
}
?>