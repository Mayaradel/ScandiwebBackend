<?php

require_once 'DatabaseConnection.php';
require_once 'Product.php';


class Furniture extends Product
{
    protected $compactDimensions;
    public function __construct($sku, $name, $price, $compactDimensions)
{
    // Call the parent constructor with only 3 parameters
    parent::__construct($sku, $name, $price);

    // Decompose compactDimensions into length, width, and height
    list($length, $width, $height) = explode('x', $compactDimensions);

    $this->length = $length;
    $this->width = $width;
    $this->height = $height;

    // Store compactDimensions
    $this->compactDimensions = $compactDimensions;
}

    public function saveToDatabase()
    {
        $type = 'Furniture';
        $additionalInfo = $this->compactDimensions;

        $this->saveToDatabaseGeneric($type, $additionalInfo);
    }
}
?>