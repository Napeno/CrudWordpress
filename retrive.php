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
    try {
        // Retrieve all products
        $page = 1;
        $products = [];

        do {
            $response = json_decode(json_encode($woocommerce->get('products', ['per_page' => 100, 'page' => $page, 'order' => 'asc', 'order_by' => 'id'])), true);
            if (is_array($response)) {
                $products = array_merge($products, $response);
                $page++;
            } else {
                // Break the loop if response is not an array
                break;
            }
        } while (!empty($response));

        // Output products as JSON
        header('Content-Type: application/json');
        echo json_encode($products);
    } catch (HttpClientException $e) {
        // Handle exception
        echo json_encode(['error' => 'Failed to retrieve products: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
