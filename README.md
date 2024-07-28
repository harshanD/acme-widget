# Acme Widget Co Sales System

This is a proof of concept for the new sales system for Acme Widget Co. It handles product orders, delivery charges, and special offers. The implementation is in PHP and includes a `Basket` class with the following functionality:

- Initialize the basket with a product catalog, delivery charge rules, and special offers.
- Add products to the basket.
- Calculate the total cost of the basket, taking into account delivery charges and special offers.
- Format the total to three decimal places and truncate to two decimal places.

## Product Catalog

The product catalog includes the following products:

| Product Code | Product Name | Price  |
|--------------|--------------|--------|
| R01          | Red Widget   | $32.95 |
| G01          | Green Widget | $24.95 |
| B01          | Blue Widget  | $7.95  |

## Delivery Charges

Delivery charges are based on the total order amount:

- Orders under $50 cost $4.95.
- Orders under $90 cost $2.95.
- Orders of $90 or more have free delivery.

## Special Offers

The initial special offer is:

- "Buy one red widget, get the second half price."

## Basket Class

The `Basket` class provides the following methods:

### Constructor

Initializes the basket with a product catalog, delivery charge rules, and special offers.

```php
public function __construct($productCatalog, $deliveryCharges, $specialOffers)
```


### Add Method

Adds a product to the basket using its product code.

```php
public function add($productCode)
```

### Total Method

Calculates and returns the total cost of the basket. The total cost is formatted to three decimal places and truncated to two decimal places.

```php
public function total()
```

### Reset Method

Resets the basket by clearing all items.

```php
public function reset()
```

### Installation

1. Clone the repository:
```sh
git clone https://github.com/yourusername/acme-widget-co-sales-system.git
```

2. Navigate to the project directory:
```sh
cd acme-widget-co-sales-system
```

3. Include the Basket class in your project:
```php
require_once 'Basket.php';
```

## Usage Example

```php
require 'Basket.php';

$productCatalog = [
    'R01' => 32.95,
    'G01' => 24.95,
    'B01' => 7.95
];

$deliveryCharges = [
    'under_50' => 4.95,
    'under_90' => 2.95,
    'over_90' => 0.00
];

$specialOffers = [
    'R01' => ['buy' => 1, 'get' => 0.5]
];

$basket = new Basket($productCatalog, $deliveryCharges, $specialOffers);

$basket->add('B01');
$basket->add('G01');
echo "Total: $" . $basket->total() . "\n"; // Total: $37.85

$basket->reset();
$basket->add('R01');
$basket->add('R01');
echo "Total: $" . $basket->total() . "\n"; // Total: $54.37

$basket->reset();
$basket->add('R01');
$basket->add('G01');
echo "Total: $" . $basket->total() . "\n"; // Total: $60.85

$basket->reset();
$basket->add('B01');
$basket->add('B01');
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');
echo "Total: $" . $basket->total() . "\n"; // Total: $98.27

```

## Notes

- The total is formatted to three decimal places and then truncated to two decimal places to ensure accuracy and consistency in pricing.
- Ensure all product codes in the basket exist in the product catalog to avoid exceptions.

## Assumptions

- All prices are provided in USD and are accurate to two decimal places.
- The product catalog contains all available product codes, and no additional products can be added without updating the catalog.
- Delivery charges are fixed and based on the total order amount before applying any discounts or special offers.
- Special offers are applied in the order they are defined in the special offers list.
- The special offer "buy one red widget, get the second half price" applies only once per pair of red widgets. Additional red widgets beyond pairs are charged at the full price unless more pairs are added.
- The basket calculation does not account for any potential taxes or additional fees that may apply.
- The total is formatted to three decimal places for calculation accuracy but is truncated to two decimal places for display purposes.
- The basket is reset (cleared of all items) each time the `reset` method is called.
- It is assumed that the `Basket` class methods are used correctly and that product codes passed to the `add` method exist in the product catalog.

## License
This project is licensed under the MIT License - see the `LICENSE` file for details.