<?php

class Basket
{
    private $productCatalog;
    private $deliveryCharges;
    private $specialOffers;
    private $items = [];

    public function __construct($productCatalog, $deliveryCharges, $specialOffers)
    {
        $this->productCatalog  = $productCatalog;
        $this->deliveryCharges = $deliveryCharges;
        $this->specialOffers   = $specialOffers;
    }

    /**
     * add product to items queue(Basket)
     * @param $productCode
     * @throws Exception
     */
    public function add($productCode)
    {
        if (isset($this->productCatalog[$productCode])) {
            $this->items[] = $productCode;
        } else {
            throw new Exception("Product code $productCode not found in catalog.");
        }
    }

    /**
     * get the total
     * @return string
     */
    public function total()
    {
        $total      = 0.00;
        $itemCounts = array_count_values($this->items);

        foreach ($itemCounts as $productCode => $count) {
            $price    = $this->productCatalog[$productCode];
            $subtotal = 0.00;

            // Apply special offers if applicable
            if (isset($this->specialOffers[$productCode])) {
                $offer          = $this->specialOffers[$productCode];
                $offerSets      = intdiv($count, $offer['buy'] + 1); // Number of offer sets
                $remainingItems = $count % ($offer['buy'] + 1);      // Items not part of any offer set

                // Calculate subtotal for offer sets and remaining items
                $subtotal += $offerSets * ($offer['buy'] * $price + $offer['get'] * $price);
                $subtotal += $remainingItems * $price;
            } else {
                // Regular pricing for items without offers
                $subtotal = $count * $price;
            }

            // Add subtotal to total, rounding to 3 decimal places
            $total += round($subtotal, 3);
        }

        // Calculate delivery charges
        if ($total < 50) {
            $total += $this->deliveryCharges['under_50'];
        } elseif ($total < 90) {
            $total += $this->deliveryCharges['under_90'];
        }

        // Format total to 3 decimal places and truncate to 2 decimal places
        return substr(number_format($total, 3), 0, -1);
    }

    /**
     * reset items(Basket) array
     */
    public function reset()
    {
        $this->items = [];
    }
}
