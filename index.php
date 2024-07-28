<?php
require 'Basket.php';

// Product catalog with prices
$productCatalog = [
    'R01' => 32.95,
    'G01' => 24.95,
    'B01' => 7.95
];

// Delivery charges based on order total
$deliveryCharges = [
    'under_50' => 4.95,
    'under_90' => 2.95,
    'over_90'  => 0.00
];

// Special offers available
$specialOffers = [
    'R01' => ['buy' => 1, 'get' => 0.5]
];

// Initialize basket with product catalog, delivery charges, and special offers
$basket = new Basket($productCatalog, $deliveryCharges, $specialOffers);

// Function to handle newline character based on environment
function isWebOrCli()
{
    return (php_sapi_name() == "cli") ? "\n" : "<br>";
}

// Function to process basket items and display total
function processBasket($basket, $items)
{
    $basket->reset();
    foreach ($items as $item) {
        $basket->add($item);
    }
    echo "Total: $" . $basket->total() . isWebOrCli();
}

// Example baskets
processBasket($basket, ['B01', 'G01']);
processBasket($basket, ['R01', 'R01']);
processBasket($basket, ['R01', 'G01']);
processBasket($basket, ['B01', 'B01', 'R01', 'R01', 'R01']);
