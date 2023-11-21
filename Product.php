<?php

abstract class Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    public function __construct($sku, $name, $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getType(): string
    {
        return $this->type;
    }

    abstract public function saveToDatabase();

    protected function saveToDatabaseGeneric($type, $additionalInfo)
    {

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=database2", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("INSERT INTO products (sku, name, price, type, value) VALUES (?, ?, ?, ?, ?)");

            $stmt->execute([
                $this->sku,
                $this->name,
                $this->price,
                $type,
                json_encode($additionalInfo)
         ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>