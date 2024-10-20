<?php
namespace Model;
class Product extends Model
{
    private int $id;
    private string $image;
    private string $name;
    private string $description;
    private string $price;


    public function showCatalog(): array|null
    {

        $stmt = $this->pdo->query("SELECT * FROM products");
        $data = $stmt->fetchAll();
        if($data === false) {
            return null;
        }
        foreach($data as $product) {
            $obj = new Product();
            $obj->id = $product["id"];
            $obj->image = $product["image"];
            $obj->name = $product["name"];
            $obj->description = $product["description"];
            $obj->price = $product["price"];

            $products[]=$obj;
        }
        return $products;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
}

