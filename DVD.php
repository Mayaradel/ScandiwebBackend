<?php

require_once 'DatabaseConnection.php';
require_once 'Product.php';

class DVD extends Product
{
    protected $size;
    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function saveToDatabase()
    {
        $type = 'DVD';
        $additionalInfo = $this->size;

        $this->saveToDatabaseGeneric($type, $additionalInfo);
    }
}
?>