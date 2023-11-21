<?Php

require_once 'Book.php';
require_once 'DVD.php';
require_once 'Furniture.php';
class ProductFactory
{
    public static function createProduct($sku, $name, $price, $type, $additionalInfo = null)
    {
        switch ($type) {
            case 'Book':
                return new Book($sku, $name, $price, $additionalInfo);
            case 'DVD':
                return new DVD($sku, $name, $price, $additionalInfo);
            case 'Furniture':
                return new Furniture($sku, $name, $price, $additionalInfo);
            default:
                throw new InvalidArgumentException("Invalid product type: $type");
        }
    }
}
?>