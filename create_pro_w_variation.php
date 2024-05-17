<?php
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
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $num_variations = $_POST['num_variations'];

    $variations = [];
    for ($i = 0; $i < $num_variations; $i++) {
        $regular_price = $_POST["regular_price_$i"];
        $size = $_POST["size_$i"];
        $color = $_POST["color_$i"];
        $stock_quantity = $_POST["stock_quantity_$i"];

        $variations[] = [
            'regular_price' => $regular_price,
            'attributes' => [
                [
                    'name' => 'Size',
                    'option' => $size
                ],
                [
                    'name' => 'Color',
                    'option' => $color
                ]
            ],
            'stock_quantity' => $stock_quantity
        ];
    }

    $data = [
        'name' => $product_name,
        'type' => 'variable',
        'description' => $product_description,
        'attributes' => [
            [
                'name' => 'Size',
                'variation' => true,
                'options' => array_unique(array_column($variations, 'size'))
            ],
            [
                'name' => 'Color',
                'variation' => true,
                'options' => array_unique(array_column($variations, 'color'))
            ]
        ],
        'variations' => $variations
    ];

    try {
        $response = $woocommerce->post('products', $data);
        echo "New variable product created: " . $response->name . " (ID: " . $response->id . ")";
    } catch (Exception $e) {
        echo "Error creating product: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
