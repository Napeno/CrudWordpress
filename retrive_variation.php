<?php
// Load Composer's autoload file
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

header('Content-Type: application/json');


$woocommerce = new Client(
    'https://www.muchmade.id.vn',
    'ck_eecf7bf41059cfc863199c798aa6cc531f6520fc',
    'cs_c92f287761ba6c1cdc8997673f752abde3763f1d',
    [
        'wp_api' => true,
        'version' => 'wc/v3'
    ]
);

try {
    // Retrieve all products
    $products = $woocommerce->get('products');
    $result = [];

    foreach ($products as $product) {
        $item = [
            'name' => $product->name,
            'id' => $product->id,
            'type' => $product->type,
            'variations' => []
        ];

        if ($product->type == 'variable') {
            $variations = $woocommerce->get('products/' . $product->id . '/variations');
            foreach ($variations as $variation) {
                $attributes = [];
                foreach ($variation->attributes as $attribute) {
                    $attributes[] = $attribute->name . ": " . $attribute->option;
                }
                $item['variations'][] = [
                    'attributes' => $attributes,
                    'stock_quantity' => $variation->stock_quantity
                ];
            }
        }

        $result[] = $item;
    }

    echo json_encode($result);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
