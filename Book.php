<?php

require_once 'DatabaseConnection.php';
require_once 'Product.php';

class Book extends Product
{
    protected $weight;
    public function __construct($sku, $name, $price, $weight)
    {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }

    public function saveToDatabase()
    {
        $type = 'Book';
        $additionalInfo = $this->weight;

        $this->saveToDatabaseGeneric($type, $additionalInfo);
    }
}
?>