<?php
namespace MiniStore\Modules\Products;

class Product
{
    private string $id;
    private string $name;
    private float $price;
    private int $stock;
    private string $description;

    public function __construct(string $id, string $name, float $price, int $stock, string $description = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->setPrice($price);
        $this->setStock($stock);
        $this->description = $description;
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getPrice(): float { return $this->price; }
    public function getStock(): int { return $this->stock; }
    public function getDescription(): string { return $this->description; }

    // Setters with validation
    public function setPrice(float $price): void
    {
        if ($price <= 0) {
            throw new \InvalidArgumentException("Price must be greater than zero");
        }
        $this->price = $price;
    }

    public function setStock(int $stock): void
    {
        if ($stock < 0) {
            throw new \InvalidArgumentException("Stock cannot be negative");
        }
        $this->stock = $stock;
    }

    public function decreaseStock(int $quantity): void
    {
        if ($quantity > $this->stock) {
            throw new \Exception("Not enough stock available");
        }
        $this->stock -= $quantity;
    }
}